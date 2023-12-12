<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Mail;
use App\Mail\SendLinks;
use App\Mail\RemainderEmail;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Yajra\Datatables\Datatables;
use PDF;
use App\Helpers\HBAHelper;

	class HomeController extends Controller{

		/*public function __construct()
    {
      $this->middleware('auth', ['only' => ['index','saveVote','getCongregation','getCongregationBasedUsers','listUsers', 'listAllUsers', 'editUser', 'updateUser', 'sendManualReminderEmail','phase_two','savePhaseTwo','phase_three','savePhaseThree']]);
    }*/

    public function index()
    {
      // die("in");
      if(Auth::user()->user_type == 'admin'){
        return $this->listUsers();
        exit;
      } else if(Auth::user()->user_type == 'priest'){
        $data['tcount'] = 5;
        $data['ausers'] = User::whereNotIn('user_type', ['admin','brother'])->get();
        $data['my_details'] = User::where('id',@Auth::user()->id)->get();
        return view('dashboard',$data);
      } else if(Auth::user()->user_type == 'brother'){
        $data['tcount'] = 5;
        $data['ausers'] = User::whereNotIn('user_type', ['admin','priest'])->get();
        $data['my_details'] = User::where('id',@Auth::user()->id)->get();
        return view('dashboard',$data);
      } else {
        die("NO USER");
      }
    	
    	
    }
public function listUsers(){
  
    return view('admin.users');
 
}
    public function saveVote(Request $request)
    {
    	$data = $this->validate($request, [
                  "mjsuperior.*" => 'required|integer'
              ]);
    	/*Update my vote Count Starts*/
      $user = User::findOrFail(Auth::user()->id);
      if($user->voted == 1){
        return redirect()->back()->with('error', 'Sorry, You have already voted !');  
      } else {
        $vdata['voted'] = 1;//Auth::user()->id;
        $vdata['voted_dtime'] = date('Y-m-d H:i:s');
        
        $u1 = $user->update($vdata);
        /*Update my vote Count Ends*/

        /*Update/Insert new vote to users Starts*/
        foreach($request->all()['mjsuperior'] as $mjskey => $mjsval){
          $fcuser = User::findOrFail($mjsval);
          $voteData['votecnt'] = $fcuser->votecnt + 1;
          $u2 = $fcuser->update($voteData);
        }
        /*Update/Insert new vote to users Ends*/
        if($u1 && $u2){
          return redirect()->back()->with('success', 'Thanks for voting');  
        } else {
          return redirect()->back()->with('error', 'Sorry, Techincal Issue... Please Try Later !');  
        }
      }
    }

		public function sendEmailLink(){
			$users = User::whereNotIn('id', [2,3,4,6,7])->get();
      
			foreach ($users as $ukey => $user) {
					$mdata = [
					'name' => $user->name,
					'role' => $user->user_type == "priest" ? 'Fr ' : 'Bro ',
					'message' => 'Greetings from the Election Commision of Indian Mission Vicariate. Please choose Five delegates to the Ⅳ-IMV Chapter '.date('Y').' according to your prefrence.',
					'note' => 'The software will not reveal your identity. It will simply total the votes.',
					'sipurl' => 'user-login/'.Crypt::encryptString(base64_encode($user->email).'/CRI/'.base64_encode('admin@123'))
				];

				$fuser = User::findOrFail($user->id);
        
        try{
          Mail::to(trim($user->email))->send(new SendLinks($mdata));
          $data['p1_email'] = 1;
          $data['p1_email_sent_at'] = date('Y-m-d H:i:s');
          $fuser->update($data);
        }
        catch(Exception $e){
          // Never reached
          dd($e);
          if(count(Mail::failures()) > 0) {
            $data['p1_email']=0;
            $fuser->update($data);
            $failures_musers[] = $user->email;
          }
          print_r($user->email);exit;
        }
			}
			

			return "Email sent successfully!";
		}
    public function listAllUsers(Request $request)
    {
        if($request->ajax()){

            //$product = User::select('*');//where('email', '!=', 'admin@gmail.com')->get();
            $product = User::whereNotIn('user_type',['admin']);
            return Datatables::of($product)
                            ->addColumn('viewLink', function ($product) {
                              $alinks = '';
                              if($product->voted == '1'){
                                $alinks .= '<a title="Send Email" href="'.route('remind-email',array(HBAHelper::encryptUrl(@$product->id))).'" class="btn btn-danger"><i class="material-icons">email</i></a>'; 
                              } else {
                                $alinks .= '<a title="Edit" href="'.route('edit-user',array(HBAHelper::encryptUrl(@$product->id))).'" class="btn btn-info"><i class="material-icons">create</i></a> <a title="Send Email" href="'.route('remind-email',array(HBAHelper::encryptUrl(@$product->id))).'" class="btn btn-danger"><i class="material-icons">email</i></a>';
                              }
                              return $alinks;

                            })->editColumn('voted_dtime', function ($product) {
                                return HBAHelper::getvotedDateTime($product->voted_dtime);
                            })->editColumn('p1_remainder_at', function ($product) {
                                return HBAHelper::getvotedDateTime($product->p1_remainder_at);
                            })->addColumn('voted', function($product){
                                 if($product->voted){
                                    return '<span class="badge bg-green">Voted</span>';
                                 }else{
                                    return '<span class="badge bg-red">Not Voted</span>';
                                 }
                            })->filter(function ($instance) use ($request) {
                                if(!empty($request->get('voted'))){
                                  if ($request->get('voted') == '1') {
                                      $instance->where('voted', $request->get('voted'));
                                  } else if($request->get('voted') == '2'){
                                      $instance->where('voted','!=','1');
                                  }

                                }
                                if(!empty($request->get('search')['value'])) {
                                     $instance->where(function($w) use($request){
                                        $search = $request->get('search')['value'];
                                        $w->orWhere('name', 'LIKE', "%$search%")
                                        ->orWhere('email', 'LIKE', "%$search%")
                                        ->orWhere('congregation', 'LIKE', "%$search%")
                                        ->orWhere('cong_abbr', 'LIKE', "%$search%");
                                    });
                                }
                                $instance->where('email', '!=', 'admin@gmail.com');
                                $instance->orderBy('voted_dtime', 'DESC');
                            })->rawColumns(['viewLink','voted'])
                            ->make(true);
        }
    }
    public function sendManualReminderEmail(Request $request, $id){
      if(!empty($id)){
        $getUser = User::findOrFail(HBAHelper::decryptUrl($id));
        if(!empty($getUser)){

          $role = '';
          if($getUser->user_type == "brother"){
            $role = 'Brothers';
            $r1 = 'Br.';
            $mscnt = 'Five';
          } else if($getUser->user_type == "sister"){
            $role = 'Sisters';
            $r1 = 'Sr.';
            $mscnt = 'Seven';
          } else if($getUser->user_type == "priest"){
            $role = 'Priests';
            $r1 = 'Fr.';
            $mscnt = 'Five';
          }

          $data = ['message' => 'Greetings from National CRI Office, This is a <b>Reminder Email</b> to request you to choose '.$mscnt.' Major Superiors of the '.$role.' section (Eg. '.$r1.' John Doe ABC) who are the best persons, in your opinion, to form the Sectional Executive from '.date("Y").' - 2024. The software will not reveal your identity. It will simply total the votes.',
                  'subject'=>trans('main.msubjectr'),
                  'to'=>$getUser->email,
                  'name'=>$getUser->name,
                  'sipurl' => 'user-login/'.Crypt::encryptString(base64_encode($getUser->email).'/CRI/'.base64_encode('admin@123')),
                  // 'sipurl'=>'/user-login/'.base64_encode($getUser->email.'/CRI/'.$getUser->cus_pwd),
                  'role'=>$r1
                ];
          try{
            Mail::to(trim($getUser->email))->send(new RemainderEmail($data));
            $remCont = $getUser->p1_remainder + 1;
            \DB::statement("UPDATE users SET p1_remainder = ".$remCont.", p1_remainder_at = '".date('Y-m-d h:i:s')."' where id = ".$getUser->id." ");
            return redirect()->route('users')->with('success','Reminder Mail Sent');
          }
          catch(Exception $e){
            if(count(Mail::failures()) > 0) {
              $data['p1_remainder']= ($getUser->p1_remainder == '0') ? '0' : $getUser->p1_remainder - 1;
              $getUser->update($data);
              $failures_musers[] = $getUser->email;
            }
            print_r($getUser->email);exit;
          }
        } else {
            return redirect()->route('users')->with('error','No Such Data');
        }
      } else {
        return redirect()->route('users')->with('error','No Such Data');
      }
    }

    public function editUser(Request $request, $id){
      if(!empty($id)){
        $getUser['user'] = User::findOrFail(HBAHelper::decryptUrl($id));
        if(!empty($getUser['user'])){
            return view('admin.editUser', $getUser);
        } else {
            return redirect()->route('users')->with('error','No Such Data');
        }
      } else {
        return redirect()->route('users')->with('error','No Such Data');
      }
    }
    public function backendDashboard(){
      //if(date('d-m-Y') == trans('main.res_date')){
        //$data['users'] = User::whereNotIn('user_type',['admin'])->orderBy('user_type', 'DESC')->orderBy('president', 'DESC')->orderBy('vpresident', 'DESC')->orderBy('treasurer', 'DESC')->orderBy('secretary', 'DESC')->paginate(100);
        //$data['users'] = User::whereIn('id',['137','140','165','143','169','173','171','218','234','267','347','5','53','27','436','369','522'])->orderBy('user_type', 'DESC')->orderBy('president', 'DESC')->orderBy('vpresident', 'DESC')->orderBy('treasurer', 'DESC')->orderBy('secretary', 'DESC')->paginate(100); // Second Phase
      $data['users'] = User::orderBy('user_type', 'DESC')->whereNotIn('user_type',['admin'])->orderBy('id', 'ASC')->paginate(100);
      
      return view('admin.adashboard',$data);
      //} else {
        //return redirect()->route('users')->with('error','Result Page cannot be show until 08-11-2021');
      //}
    }
    public function generatePdfVote() {
      if(!empty(base64_decode($_GET['pval']))){
        if(base64_decode($_GET['pval']) == "all"){
          //Phase 1
          /*$data['users'] = User::whereNotIn('user_type',['admin'])
                                ->orWhere('president','>',0)
                                ->orWhere('vpresident','>',0)
                                ->orWhere('treasurer','>',0)
                                ->orWhere('secretary','>',0)
                                ->orderBy('president','DESC')
                                ->orderBy('vpresident','DESC')
                                ->orderBy('treasurer','DESC')
                                ->orderBy('secretary','DESC')
                                ->get();
          $data['role'] = ucfirst(base64_decode($_GET['pval']));
          //return view('report',$data);
          $pdf = PDF::loadView('report', $data)->setPaper('a4', 'portrait');;
          return $pdf->download(ucfirst(base64_decode($_GET['pval'])).'_'.time().'.pdf');*/
          //Phase 3
          $data['users'] = User::whereNotIn('user_type',['admin'])
                                // ->where('eligible','1')
                                ->orderBy('votecnt','DESC')
                                ->get();
          $data['role']       = 'Total User';
          $data['voted']      = User::where('voted','1')->whereNotIn('user_type',['admin'])->count();
          $data['notvoted']   = User::where('voted','0')->whereNotIn('user_type',['admin'])->count();
          $data['totalusers'] = User::whereIn('user_type',['priest','decan','brother'])->count();
          $data['percentage'] = ($data['voted']/$data['totalusers'])*100;
          //return view('report',$data);
          $pdf = PDF::loadView('report', $data)->setPaper('a4', 'portrait');
          return $pdf->download(ucfirst(base64_decode($_GET['pval'])).'_'.time().'.pdf');
        } else {
          /*$data_utype_rept = User::whereNotIn('user_type',['admin'])
                                ->Where('user_type', base64_decode($_GET['pval']))
                                ->orWhere('president', '>', 0)
                                ->orWhere('vpresident', '>', 0)
                                ->orWhere('treasurer', '>', 0);
          if(base64_decode($_GET['pval']) == 'sister'){
            $data_utype_rept->orWhere('secretary', '>', 0);
          }
          $data_utype_rept->orderBy('president', 'DESC')
                                ->orderBy('vpresident', 'DESC')
                                ->orderBy('treasurers', 'DESC');
          if(base64_decode($_GET['pval']) == 'sister'){
            $data_utype_rept->orderBy('secretary', 'DESC');
          }

                                
          $data['users'] = $data_utype_rept->get();*/
          //Phase 2
          /*$data['role'] = ucfirst(base64_decode($_GET['pval']));
          $data_utype_rept = User::where(function($query) {
                                          $query->orWhere('president','>',0)
                                              ->orWhere('vpresident','>',0)
                                              ->orWhere('treasurer','>',0);
                                          if(base64_decode($_GET['pval']) == 'sister'){
                                            $query->orWhere('secretary', '>', 0);
                                          }
                                      })
                              ->whereNotIn('user_type',['admin'])
                              ->where('user_type',base64_decode($_GET['pval']))
                              ->orderBy('president','DESC')
                              ->orderBy('vpresident','DESC')
                              ->orderBy('treasurer','DESC');
                              if(base64_decode($_GET['pval']) == 'sister'){
                                $data_utype_rept->orderBy('secretary','DESC');
                              }
          $data['users'] = $data_utype_rept->get();
          $data['voted'] = User::where('p2_voted','1')->where('user_type',base64_decode($_GET['pval']))->count();
          $data['notvoted'] = User::where('p2_voted','0')->where('user_type',base64_decode($_GET['pval']))->count();
          $data['totalusers'] = User::where('user_type',base64_decode($_GET['pval']))->count();
          $data['percentage'] = ($data['voted']/$data['totalusers'])*100;*/
          //return view('report',$data);


          $data['users'] = User::whereNotIn('user_type',['admin'])
                                ->where('user_type',base64_decode($_GET['pval']))
                                // ->where('eligible','1')
                                ->orderBy('votecnt','DESC')
                                ->get();
          $data['role']       = ucfirst(base64_decode($_GET['pval']));
          $data['voted']      = User::where('voted','1')->where('user_type',base64_decode($_GET['pval']))->whereNotIn('user_type',['admin'])->count();
          $data['notvoted']   = User::where('voted','0')->where('user_type',base64_decode($_GET['pval']))->whereNotIn('user_type',['admin'])->count();
          $data['totalusers'] = User::where('user_type',base64_decode($_GET['pval']))->count();
          $data['percentage'] = ($data['voted']/$data['totalusers'])*100;
          //return view('report',$data);
          $pdf = PDF::loadView('report', $data)->setPaper('a4', 'portrait');
          return $pdf->download(ucfirst(base64_decode($_GET['pval'])).'_'.time().'.pdf');
        }
      } else {
        return redirect()->back()->with('error', 'Server Issue Please Wait...');  
      }
    }
	}
?>