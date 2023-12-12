<?php
/**
 * PHP version 7 and Laravel version 5.6.22
 *
 * @package         Helper
 * @Purpose         TO Manage Helper Functions
 * @File            STCHelper.php
 * @Author          A.C Jerin Monish
 * @Modified By     A.C Jerin Monish
 * @Created Date    13-02-2019
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Image;
use Mail;
use DB;
use URL;
use App\Models\Cms;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Slider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Request;
use DateTime;

class HBAHelper
{


    // To User name
    public static function getUserDetails($id) {
        if($id){
            $get_name = User::select('*')->where('id', $id)->first();
            return $get_name;
        } else {
            return false;
        }
    }

    public static function getvotedDateTime($datetime){
      if(!empty($datetime)){
        $utc = $datetime;
        $dt = new \DateTime($utc);
        $tz = new \DateTimeZone('Asia/Kolkata');
        $dt->setTimezone($tz);
        return $dt->format('d-m-Y h:i: A');//$dt->format('r');
      } else {
        return '0000-00-00 00:00';
      }
    }

    // To get main album name with id name and year
    public static function getCatName($id) {
        $catname = Category::where('id', $id)->first();
        return $catname;
    }

    // To get main album name with id name and year
    public static function getProductName($id) {
        $catname = Product::where('id', $id)->first();
        return $catname;
    }

    // To encrypt id in url
    public static function encryptUrl($id) {
        if($id){
            $id = base64_encode(($id + 122354125410));
            return $id;
        }
    }

    // To decrypt id in url
    public static function decryptUrl($id) {
        if(is_numeric(base64_decode($id))){
            $id = explode(",", base64_decode($id))[0] - 122354125410;
            return $id;
        }
        abort(404);
    }

    // To get all testimonial
    public static function getHotSaleProducts($cnt) {
        $data = Product::where('pstatus', 'Hot')->where('status', 'Active')->OrderBy('id', 'desc')->take($cnt)->get();
        return $data;
    }

    /**
     * To fetch the limited category based on count
     *
     * @return value
     */
    public static function getlimCategory($cnt)
    {
        $data = Category::where('status', 'Active')->OrderBy('id', 'desc')->take($cnt)->get();
        return $data;
    }

    /**
     * To fetch the limited product based on count
     *
     * @return value
     */
    public static function getlimProduct($cnt)
    {
        $data = Product::where('status', 'Active')->orderByRaw('RAND()')->take($cnt)->get();
        return $data;
    }

    /**
     * To fetch the Slider
     *
     * @return array
     */
    public static function home_slider_alone()
    {
        $data = Slider::where('status', 'Active')->get();
        return $data;
    }

     // To get all testimonial
    public static function getHomeNewProducts($cnt) {
        $data = Product::where('pstatus', 'snew')->where('status', 'Active')->OrderBy('id', 'desc')->take($cnt)->get();
        return $data;
    }

    

    /**
     * To fetch the stamps
     *
     * @return value
     */
    public static function getallCategory()
    {
        $data['category'] = Category::where('status', 'Active')->get();
        return $data['category'];
    }

    /**
     * To fetch the whether product exists in stock and available for sale and return its cart
     *
     * @return value
     */
    public static function checkProductwithCartData($id,$status=false,$userid=false)
    {
        $status = !empty($status) ? $status : "Incart";
        $userid = !empty($userid) ? $userid : @Auth::user()->id;
        $check_product_cart = self::checkIfalreadyIncart($id,$status,$userid);
        // echo '<pre>';print_r($check_product_cart);exit;
        if(empty($check_product_cart)/* && $check_product_cart[0]->user_id*/){
            $cat['product'] = \DB::select("select p.pr_name,p.cat_id, p.pr_mslug, p.pr_description, p.pr_price, p.pr_image, p.pstatus, p.status, p.created_at, p.updated_at, p.id AS id, ct.category_name, sct.sub_category_name, t.tag_name, count(stk.id) as stockcount,sum(COALESCE(stk.original_stk,0)) as Orginalstock, pur.product_id,COALESCE(pur.purc,0) as salesstock, (sum(COALESCE(stk.original_stk,0)) - COALESCE(pur.purc,0)) as product_available_stk from product p join category ct on p.cat_id = ct.id join sub_category sct on p.sub_id = sct.id join tags t on p.tags = t.id LEFT JOIN stock stk on p.id=stk.product_id LEFT JOIN (select pu.product_id, sum(COALESCE(quantity,0)) as purc from purchased pu where pu.product_id=".$id." and pu.purchased_status='Payment_done') pur on p.id=pur.product_id where p.id =".$id." group by p.id,pur.purc");
            return $cat['product'];
        } else {
            return false;
        }
    }
    /**
     * To fetch the whether product exists in cart
     *
     * @return value
     */
    public static function checkIfalreadyIncart($id,$status=false,$userid=false){
        $status = !empty($status) ? $status : "Incart";
        $userid = !empty($userid) ? $userid : @Auth::user()->id;
        if(!empty($id)){
            $check['carttab'] = \DB::select("SELECT * FROM purchased where product_id = ".$id." AND purchased_status = '".$status."' AND user_id = ".$userid." ");
            return $check['carttab'];
        } else {
            return false;
        }
    }

    /**
     * To fetch the whether product exists in cart based on user id
     *
     * @return value
     */
    public static function getCartDataUserBased($id){
        if(!empty($id)){
            $check['cart'] = \DB::select("SELECT p.pr_name,p.pr_price,p.id productid,p.pr_image,pur.id purid,pur.quantity,pur.cart_dated from product p JOIN purchased pur ON p.id = pur.product_id WHERE pur.user_id = ".$id." AND pur.purchased_status='Incart'");
            return $check['cart'];
        } else {
            return false;
        }
    }

    // To get all testimonial
    public static function getOneAlbumName($id) {
        $data = Album::where('id', $id)->get();
        return $data;
    }

    // To set first 19 chars
    public static function charRestrictions($id) {
        if($id){
                $charStr = strlen($id);
            if($charStr > 19){
                $charStr = substr($id, 0, 250);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }

    // To set first 19 chars
    public static function charRestrictionsTeamHomePage($id) {
        if($id){
                $charStr = strlen($id);
            if($charStr > 19){
                $charStr = substr($id, 0, 45);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }


    // To set first 103 chars
    public static function charRestrictionsEventsMain($id) {
        if($id){
            $charStr = strlen($id);
            if($charStr > 103){
                $charStr = substr($id, 0, 103);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }

    // To set first 140 chars
    public static function charRestrictionsNews($id) {
        if($id){
            $charStr = strlen($id);
            if($charStr > 140){
                $charStr = substr($id, 0, 140);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }

    // To set first 140 chars
    public static function charRestrictionsFooterNews($id) {
        if($id){
            $charStr = strlen($id);
            if($charStr > 35){
                $charStr = substr($id, 0, 35);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }

    public static function formatSizeUnits($bytes){
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }elseif ($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }elseif ($bytes >= 1024){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }elseif ($bytes > 1){
            $bytes = $bytes . ' bytes';
        }elseif ($bytes == 1){
            $bytes = $bytes . ' byte';
        }else{
            $bytes = '0 bytes';
        }
        return $bytes;
}

    // To set first 25 chars
    public static function charRestrictionsArt($id) {
        if($id){
                $charStr = strlen($id);
            if($charStr > 25){
                $charStr = substr($id, 0, 25);
                $setChar = $charStr.'...';
            } else {
                $setChar = $id;
            }
            return $setChar;
        }
    }

    // To load donated year
    public static function yearRange() {
        for($i=1700;$i<=date('Y');$i++) {
            $year_data[$i] = $i;
        }
        return $year_data;
    }

    // To load category year
    public static function catYear() {
        for($i=2000;$i<=date('Y');$i++) {
            $year_data[$i] = $i;
        }
        return $year_data;
    }

    // To get grade name
    public static function getGrade($id) {
        if($id){
            $get_grade = CoinsGrade::select('grade')->where('id', $id)->first();
            return $get_grade['grade'];
        } else {
            return false;
        }
    }

    // To get country name
    public static function getCountry($id) {
        if($id){
            $get_country = Country::select('country_name')->where('id', $id)->first();
            return $get_country['country_name'];
        } else {
            return false;
        }
    }

    public static function dbcheck(){
        $check = env('ONLINEDB');
        if($check == 1){
            try {
                    DB::connection('mysql2')->getPdo();
                    if(DB::connection('mysql2')->getDatabaseName()){
                        //echo "Yes! Successfully connected to the DB: " . DB::connection('mysql2')->getDatabaseName();
                        return 1;
                    }
                } catch (\Exception $e) {
                    return 0;
                }
        } else {
            return 0;
        }
    }

    // To get Continents name
    public static function getContinents($id) {
        if($id){
            $get_country = Continents::select('continent_name')->where('id', $id)->first();
            return $get_country['continent_name'];
        } else {
            return false;
        }
    }

    // To get events name
    public static function getAllEventsName() {
            $get_event = NewsEvents::select('*')->where('main_type', 'Events')->where('status', 'Active')->OrderBy('from_event', 'desc')->get();
            return $get_event;
    }

    // To get keywords name
    public static function getKeywords($id) {
        if($id){
            $get_keywords = Keywords::select('keywords')->where('id', $id)->first();
            return $get_keywords['keywords'];
        } else {
            return false;
        }
    }

    // To get all country
    public static function getAllCountry() {
            $all_country['country'] = Country::all();
            return $all_country;
    }

    // To get state name
    public static function getState($id) {
        if($id){
            $get_state = State::select('state_name')->where('id', $id)->first();
            return $get_state['country_name'];
        } else {
            return false;
        }
    }

    // To get all country
    public static function getAllPhotoGallery($id) {
        if($id){
            $photoGallery   = PhotoGallery::select('*')->where('id', $id)->first();
            $photoGalleryre = PhotoGallery::select('*')
                                            ->where('main_category_id', $photoGallery['main_category_id'])
                                            ->where('sub_category_id', $photoGallery['sub_category_id'])
                                            ->where('album_id', $photoGallery['album_id'])
                                            ->where('deleted_at', '=', Null)
                                            ->get();
            $data['main_category_id'] = $photoGallery['main_category_id'];
            $data['sub_category_id']  = $photoGallery['sub_category_id'];
            $data['album_id']         = $photoGallery['album_id'];
            $data['all_data']         = $photoGalleryre;
            return $data;
        } else {
            return false;
        }
    }

    // To get main category name
    public static function getMainCategoryId($id) {
        if($id){
            $getCatName = MainCategory::select('category_name')->where('id', $id)->first();
            return $getCatName;
        } else {
            return false;
        }
    }

    // To get main category name
    public static function getSubCatIdPictures($id,$mainCatId ) {
        if($id){
            $getCatName = PhotoGallery::select('*')->where('sub_category_id', $id)->where('main_category_id', $mainCatId)->first();
            return $getCatName;
        } else {
            return false;
        }
    }

    // To get photogallery and sub category images
    public static function getPhotoGallery($id) {
        if($id){
            $getCatAll = PhotoGallery::where('main_category_id', $id)->groupBy('sub_category_id')->where('status', 'Active')->where('deleted_at',NULL)->OrderBy('id', 'desc')->get();
            return $getCatAll;
        } else {
            return false;
        }
    }

    // To get photogallery based on album id
    public static function getPhotoGalleryAlbum($id) {
        if($id){
            $getCatAll = PhotoGallery::where('sub_category_id', $id)->groupBy('album_id')->where('status', 'Active')->where('deleted_at',NULL)->OrderBy('id', 'desc')->get();
            return $getCatAll;
        } else {
            return false;
        }
    }

    // To get first letter caps
    public static function firstLetterCaps($id) {
        if($id){
            $capLetter = ucfirst($id);
            return $capLetter;
        } else {
            return false;
        }
    }

    // To get subcategory name
    public static function getSubCategoryId($id) {
        if($id){
            $getSubCatName = SubCategory::select('sub_category_name')->where('id', $id)->first();
            return $getSubCatName;
        } else {
            return false;
        }
    }

    // To get subcategory name
    public static function getSubCategoryBasedCategory($id) {
        if($id){
            $getSubCatName['scategories'] = SubCategory::where('cat_id', $id)->get();
            return $getSubCatName;
        } else {
            return false;
        }
    }

    // To get album name
    public static function getAlbumID($id) {
        if($id){
            $getAlbName = Album::select('title')->where('id', $id)->first();
            return $getAlbName;
        } else {
            return false;
        }
    }

    // To get album name
    public static function getAlbumName($id) {
        if($id){
            $getAlbName = Album::select('title')->where('id', $id)->first();
            return $getAlbName->title;
        } else {
            return false;
        }
    }

    // To set unique image name
    public static function setImageName($name) {
        if($name){
            $set_name = time().$name;
            return $set_name;
        } else {
            return false;
        }
    }

    // To set pagination per page
    public static function setPaginationNo() {
        $pageSize = 9;
        return  $pageSize;
    }

    // To set No Image name
    public static function setNoImage($b_path,$img_name){
        $path = base_path().'/'.$b_path.'/'.$img_name;
        //if(\File::exists($path))
        if($img_name){
            return $b_path.'/'.$img_name;
        } else {
            $src = URL::to(trans('main.noimag.noimage'));
            return $src;
        }
    }

    // To encrypt Image name
    public static function encryptImageName($path,$get_img){
        //die($path);
        if(\File::exists($path)){
            $image = $get_img;
            $overall_path = $path;
            // Read image path, convert to base64 encoding
            $imageData = base64_encode(file_get_contents($overall_path));
            // Format the image SRC:  data:{mime};base64,{data};
            $src = 'data: '.mime_content_type($overall_path).';base64,'.$imageData;
            return $src;
        } else {
            $src = URL::to(trans('main.news_events.noimage'));
            return $src;
        }
    }

    // To User name
    public static function getUserName($id) {
        if($id){
            $get_name = User::select('name','last_name')->where('id', $id)->first();
            return @$get_name['name'].' '.@$get_name['last_name'];
        } else {
            return false;
        }
    }

    // To User name
    public static function getUserImage($id) {
        if($id){
            $get_name = User::select('profile_pic')->where('id', $id)->first();
            return $get_name['profile_pic'];
        } else {
            return false;
        }
    }

    // format date to india format
    public static function formatDate($date=false,$format = 'd.m.Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // return year from data
    public static function EventsYearData($date=false,$format = 'Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // return year with date from data
    public static function EventsYearMonData($date=false,$format = 'M d') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // return year with date from data
    public static function NewsYearMonDate($date=false,$format = 'd M, Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // format date to india format
    public static function manuFormatDate($date=false,$format = 'd-m-Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // format date to india format
    public static function adminViewDate($date=false,$format = 'd-M-Y h:i:s A') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $curDate = date("d-M-Y H:i:s");
            return $curDate;
        }
    }


    // format date to mysql format
    public static function formatMysqlDate($date,$format = 'Y-m-d') {
        if($date) {
            /*$date = new \DateTime($date);
            return $date->format($format);*/
            return date($format, strtotime($date));
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

     /*
    * return the number with the given limit - particularly for the float numbers
    */
    public static function mysqlDateTime($date=FALSE, $format = 'Y-m-d h:m:s'){
       if($date){
            return date($format, strtotime($date));
       }else{
            return date($format);
       }
    }

    public static function scriptmysqlDateTime($date=FALSE, $format = 'd/m/Y'){
       if($date){
            return date($format, strtotime($date));
       }else{
            return date($format);
       }
    }

    /*
     *  This is the function to return seo title
     */

    public static function getSeo($seo) {
		$str = strtolower($seo);
		$seoTitle = strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($str))));
		return $seoTitle;
    }

	/*
     *  This is the function to return order by
     */

    public static function get_order_by() {
        $array = (['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10',]);
        return $array;
    }

    public static function news_events_date($data) {
        $new_date = date('M. d, Y', strtotime($data));
        return $new_date;
    }

    public static function news_detailpage_date($data) {
        $new_date = date('F d, Y', strtotime($data));
        return $new_date;
    }


    /**
    * To fetch the news & events
    *
    * @return value
    */
    public static function sidebarEvents()
    {
        $data['events'] = NewsEvents::where('main_type', 'Events')->where('status', 'Active')->OrderBy('id', 'desc')->take(3)->where('status', 'Active')->get();
        if($data['events']){
            return $data;
        } else {
            return false;
        }
    }

    /**
    * To fetch the news & events
    *
    * @return value
    */
    public static function sidebarNews()
    {
        $data['news'] = NewsEvents::where('main_type', 'News')->where('news_latest', 1)->where('status', 'Active')->OrderBy('id', 'desc')->take(3)->where('status', 'Active')->get();
        if($data['news']){
            return $data;
        } else {
            return false;
        }
    }

    /**
    * To fetch the news & events
    *
    * @return value
    */
    public static function allSidebarNews()
    {
        $data['news'] = NewsEvents::where('main_type', 'News')->where('status', 'Active')->OrderBy('id', 'desc')->take(3)->where('status', 'Active')->get();
        if($data['news']){
            return $data;
        } else {
            return false;
        }
    }

    /**
    * To fetch the news & events
    *
    * @return value
    */
    public static function HomePageEvents()
    {
        $data['events'] = NewsEvents::where('main_type', 'Events')->where('status', 'Active')->OrderBy('id', 'desc')->take(4)->where('status', 'Active')->get();
        if($data['events']){
            return $data;
        } else {
            return false;
        }
    }

    /**
    * To fetch the news & events
    *
    * @return value
    */
    public static function HomePageTeams()
    {
        $data['team'] = Team::where('status', 'Active')->orderBy(\DB::raw('RAND()'))->take(4)->where('status', 'Active')->get();
        if($data['team']){
            return $data;
        } else {
            return false;
        }
    }

    // format date to News Events
    public static function formatNewsEvents($date,$format = 'M d, Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

     /**
     * To fetch the Slider
     *
     * @return array
     */
    public static function home_slider()
    {
        $data['slider'] = Slider::OrderBy('order_by', 'asc')->where('status', 'Active')->get();
        return view('frontend.includes.slider', $data);
    }

    /**
     * To fetch the contact us from cms
     *
     * @return value
     */
    public static function homeContactUs()
    {
        $data['cms'] = Cms::where('status', 'Active')->where('seo_title', 'contact-us-1')->first();

        return $data;
    }

    /**
     * To fetch the about us from cms
     *
     * @return value
     */
    public static function homeAboutUs()
    {
        $cms = Cms::where('status', 'Active')->where('seo_title', 'about-us')->first();
        $data['cms'] = substr($cms, 0, 145);
        dd($data['cms']);
        //return $data['cms'];
    }

    /**
     * Display the tagged photo
     *
     * @return value
     */
    public static function getTaggedPhotosCount()
    {
        $data['taggedPhotoCount'] = PhotoTagging::where('admin_status', 'Inactive')->count();
        return $data;
    }

    /**
     * To fetch the contact us from cms
     *
     * @return value
     */
    public static function homePhotoGallery()
    {
        $data['photoGallery'] = Gallery::where('status', 'Active')->take(8)->inRandomOrder()->get();
        return $data;
    }

    public static function homePhotoGalleryMain()
    {
        $data['photoGallery'] = Gallery::where('status', 'Active')->take(6)->inRandomOrder()->get();
        return $data;
    }

    /**
     * To fetch the count of photo gallery
     *
     * @return value
     */
    public static function photoGalleryCount()
    {
        $data['photoGallery'] = PhotoGallery::where('status', 'Active')->count();

        return $data;
    }

    /**
     * To fetch the count of coins
     *
     * @return value
     */
    public static function coinsCount()
    {
        $data['coins'] = Coins::where('status', 'Active')->count();

        return $data;
    }

    /**
     * To fetch the coins
     *
     * @return value
     */
    public static function coinsTitle($title)
    {
        $data['coins'] = Coins::where('status', 'Active')->where('id', $title)->first();

        return $data['coins']['title'];
    }

    /**
     * To fetch the stamps
     *
     * @return value
     */
    public static function stampsTitle($title)
    {
        $data['stamps'] = Stamps::where('status', 'Active')->where('id', $title)->first();

        return $data['stamps']['title'];
    }

    /**
     * To fetch the count of stamps
     *
     * @return value
     */
    public static function stampsCount()
    {
        $data['stamps'] = Stamps::where('status', 'Active')->count();

        return $data;
    }

    /**
     * To fetch the count of artifacts
     *
     * @return value
     */
    public static function artifactsCount()
    {
        $data['artifacts'] = Artifacts::where('status', 'Active')->count();

        return $data;
    }

    /**
     * To fetch the count of users
     *
     * @return value
     */
    public static function usersCountAll()
    {
        $data['users'] = User::where('user_type', 'user')->count();

        return $data;
    }

    /**
     * To fetch the count of users today date
     *
     * @return value
     */
    public static function usersCountToday()
    {
        $data['usersToday'] = User::where('user_type', 'user')->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

        return $data;
    }

    /**
     * To fetch the count of users yesterday date
     *
     * @return value
     */
    public static function usersCountYesterday()
    {
        $data['usersYesterday'] = User::where('user_type', 'user')->whereDate('created_at', '=', Carbon::yesterday())->count();

        return $data;
    }

    /**
     * To fetch the count of users last week date
     *
     * @return value
     */
    public static function usersCountLastWeek()
    {
        $data['monday'] = date("Y-m-d", strtotime("last week monday"));
        $data['sunday'] = date("Y-m-d", strtotime("last week sunday"));
        $data['usersLastWeek'] = User::where('user_type', 'user')->whereBetween('created_at',[$data['monday'],$data['sunday']])->count();

        return $data;
    }

    /**
     * To fetch the count of users last month date
     *
     * @return value
     */
    public static function usersCountLastMonth()
    {
        $fromDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $tillDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        $data['usersLastMonth'] = User::where('user_type', 'user')->whereBetween('created_at',[$fromDate,$tillDate])->count();
        return $data;
    }

    /**
     * To fetch the count of users last year date
     *
     * @return value
     */
    public static function usersCountLastYear()
    {
        $data['usersLastYear'] = User::where('user_type', 'user')->whereYear('created_at', date('Y', strtotime('last year')))->count();
        return $data;
    }

    /**
     * To fetch the count of Feedback On Photos
     *
     * @return value
     */
    public static function feedbackCountAll()
    {
        $data['feedbackAll'] = FeedbackOnPhotos::count();

        return $data;
    }

    /**
     * To fetch the count of Feedback On Photos today date
     *
     * @return value
     */
    public static function feedbackCountToday()
    {
        $data['feedbackToday'] = FeedbackOnPhotos::where('status', 'Active')->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

        return $data;
    }

    /**
     * To fetch the count of user Request Files Count
     *
     * @return value
     */
    public static function userRequestFilesCountAll()
    {
        $data['userRequestFilesAll'] = UserRequestFiles::count();

        return $data;
    }

    /**
     * To fetch the count of user Request Files Count today date
     *
     * @return value
     */
    public static function userRequestFilesCountToday()
    {
        $data['userRequestFilesToday'] = UserRequestFiles::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

        return $data;
    }

    /**
     * To fetch the count of tag request all
     *
     * @return value
     */
    public static function tagCountAll()
    {
        $data['tag'] = PhotoTagging::count();

        return $data;
    }

    /**
     * To fetch the count of tag request today date
     *
     * @return value
     */
    public static function tagCountToday()
    {
        $data['tagToday'] = PhotoTagging::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

        return $data;
    }

    /**
     * To fetch the count of tag request yesterday date
     *
     * @return value
     */
    public static function tagCountYesterday()
    {
        $data['tagYesterday'] = PhotoTagging::whereDate('created_at', '=', Carbon::yesterday())->count();

        return $data;
    }

    /**
     * To fetch the count of tag request last week date
     *
     * @return value
     */
    public static function tagCountLastWeek()
    {
        $data['monday'] = date("Y-m-d", strtotime("last week monday"));
        $data['sunday'] = date("Y-m-d", strtotime("last week sunday"));
        $data['tagLastWeek'] = PhotoTagging::whereBetween('created_at',[$data['monday'],$data['sunday']])->count();

        return $data;
    }

    /**
     * To fetch the count of tag request last month date
     *
     * @return value
     */
    public static function tagCountLastMonth()
    {
        $fromDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $tillDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        $data['tagLastMonth'] = PhotoTagging::whereBetween('created_at',[$fromDate,$tillDate])->count();
        return $data;
    }

    /**
     * To fetch the count of tag request last year date
     *
     * @return value
     */
    public static function tagCountLastYear()
    {
        $data['tagLastYear'] = PhotoTagging::whereYear('created_at', date('Y', strtotime('last year')))->count();
        return $data;
    }

    /**
     * To insert Logs
     *
     * @return array
     */
    public static function logs($module_name,$description)
    {   $user_id = Auth::id();
        $ip = $_SERVER['SERVER_ADDR'];
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "Computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "Tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
            "Mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "Bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        foreach($devicesTypes as $deviceType => $devices) {
            foreach($devices as $device) {
                if(preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }

        $values = array('user_id' => $user_id,'module_name' => $module_name,'description'=>$description,'ip'=>$ip,'device'=>$deviceName);
        $result = DB::table('logs')->insert($values);
        $dbcheck    = STCHelper::dbcheck();
        if($dbcheck == 1){
            $datas = DB::connection('mysql2')->table('logs')->insert($values);
        }
        return $result;

    }

    /**
     * To insert ip
     *
     * @return array
     */
    public static function addreturnip()
    {
        $ip = Request::ip();
        $values = array('ipaddress' => $ip,'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d h:i:s'));
        $crosscheck = VisitorCount::where('ipaddress', $ip)->where('created_at', date('Y-m-d'))->count();
        //dd($crosscheck);
        if($crosscheck == 0){
            $result = DB::table('visitor_count')->insert($values);
        }
        $result_res = count(DB::table('visitor_count')->get());
        return $result_res;
    }

    /**
     * To check whether the profile is updated
     *
     * @return array
     */
    public static function checkProfileUpdate($id)
    {
        if($id){
            $data = User::where('id', $id)->where('profile_update_status', 'Yes')->count();
            return $data;
        }
    }



    /**
     * To updated the auto generated password for a particular email
     *
     * @return array
     */
    public static function setpasswordAttribute($password,$email){
        $data = DB::update('update users set password = ? where email = ?',[$password,$email]);
        $dbcheck    = STCHelper::dbcheck();
        if($dbcheck == 1){
            $datas = DB::connection('mysql2')->update('update users set password = ? where email = ?',[$password,$email]);
        }
        return $data;
    }

    /**
     * To get messages send to particular id
     *
     * @return array
     */
    public static function getMessages($id) {
        if($id){
            $getMsg = Messages::where('user_id', $id)->groupBy('user_id')->where('status', 'Sent')->where('viewStatus','Not Viewed')->where('deleted_at',NULL)->OrderBy('id', 'desc')->count();
            return $getMsg;
        } else {
            return false;
        }
    }

    // To get photogallery and sub category images
    public static function getPhotoGalleryImages($id) {
        if($id){
            $getImageName = PhotoGallery::where('id', $id)->where('status', 'Active')->first();
            if($getImageName){
                return $getImageName->main_photo;
            } else {
                return 'noimage';
            }

        } else {
            return false;
        }
    }
}
