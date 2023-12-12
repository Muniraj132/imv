<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
            'user_type' => 'admin',
            'password' => Hash::make('admin123@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name' => 'Dn. Aviral Kumar Mnij',
            'email' => 'aviralminjsds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Dn. Johnson Bhengra',
            'email' => 'johnsonbhengra22@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Dn. Robert Marwein',
            'email' => 'marweinrobert9@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dn. Sigeon Pradeep',
            'email' => 'pradeepsigeon@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dn. Wester David Marbaniang',
            'email' => 'davidmarbaniang7@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dn. Joby Philip Koonthamattathil',
            'email' => 'joby.philip@sofiaglobal.org',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Fr. Alexis Aseervatham',
            'email' => 'alexsds2003@yahoo.co.in',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Fr. Ambrose Damian Pynshai Lamin',
            'email' => 'amblamin@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Fr. Arockia Samy',
            'email' => 'arockiasamysds@yahoo.com',
            'password' => Hash::make('admin@123'),
        ]);
        // Fr. Ashok Reddy Vuyyuru
        DB::table('users')->insert([
            'name' => 'Fr. Ashok Reddy Vuyyuru',
            'email' => 'ashokreddysds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Benny Valliyaveettil
        DB::table('users')->insert([
            'name' => 'Fr. Benny Valliyaveettil',
            'email' => 'vsbenny@yahoo.co.uk',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Chinnaiah Bellamkonda
        DB::table('users')->insert([
            'name' => 'Fr. Chinnaiah Bellamkonda',
            'email' => 'bchinnasds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Donbosco Kharmawlong
        DB::table('users')->insert([
            'name' => 'Fr. Donbosco Kharmawlong',
            'email' => 'donswes@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. G K Prakash
        DB::table('users')->insert([
            'name' => 'Fr. G K Prakash',
            'email' => 'frgkprakash207@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Gervas Daimary
        DB::table('users')->insert([
            'name' => 'Fr. Gervas Daimary',
            'email' => 'gervasdaimarysds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Gujala Vyakula Varaprasad Rao
        DB::table('users')->insert([
            'name' => 'Fr. Gujala Vyakula Varaprasad Rao',
            'email' => 'varaprasadsds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Irudayasamy Kumar
        DB::table('users')->insert([
            'name' => 'Fr. Irudayasamy Kumar',
            'email' => 'kumarasds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. James Thapa
        DB::table('users')->insert([
            'name' => 'Fr. James Thapa',
            'email' => 'jamesthapasds13@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Johnson Vinoth Kumar
        DB::table('users')->insert([
            'name' => 'Fr. Johnson Vinoth Kumar',
            'email' => 'johnsvt@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. K J Joseph
        DB::table('users')->insert([
            'name' => 'Fr. K J Joseph',
            'email' => 'jkj468@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Kitboklang Umlong Khunsyiem
        DB::table('users')->insert([
            'name' => 'Fr. Kitboklang Umlong Khunsyiem',
            'email' => 'mkitboklang@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Ksankupar Khongwar
        DB::table('users')->insert([
            'name' => 'Fr. Ksankupar Khongwar',
            'email' => 'ksansds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Lalit Kerketta
        DB::table('users')->insert([
            'name' => 'Fr. Lalit Kerketta',
            'email' => 'lalitkerketta1984@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Lesmon Nongtdu
        DB::table('users')->insert([
            'name' => 'Fr. Lesmon Nongtdu',
            'email' => 'nlessmon@yahoo.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Lijo P. Joseph
        DB::table('users')->insert([
            'name' => 'Fr. Lijo P. Joseph',
            'email' => 'lijoljp1975@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Movin Rickson R
        DB::table('users')->insert([
            'name' => 'Fr. Movin Rickson R',
            'email' => 'ricksalmovin@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
        // Fr. Noble George Muthukattil
        DB::table('users')->insert([
            'name' => 'Fr. Noble George Muthukattil',
            'email' => 'noblesds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Perekala Anil Kumar
        DB::table('users')->insert([
            'name' => 'Fr. Perekala Anil Kumar',
            'email' => 'anilsds8@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Peter Kordor Nengnong
        DB::table('users')->insert([
            'name' => 'Fr. Peter Kordor Nengnong',
            'email' => 'peternengnongsds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Philip Pukkurayil
        DB::table('users')->insert([
            'name' => 'Fr. Philip Pukkurayil',
            'email' => 'philipsds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Probestar Nongsiej
        DB::table('users')->insert([
            'name' => 'Fr. Probestar Nongsiej',
            'email' => 'probestern@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Rajesh Toppo
        DB::table('users')->insert([
            'name' => 'Fr. Rajesh Toppo',
            'email' => 'rtoppo@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Sajimon Francis (Sebastian)
        DB::table('users')->insert([
            'name' => 'Fr. Sajimon Francis (Sebastian)',
            'email' => 'sebansds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Selvanathan
        DB::table('users')->insert([
            'name' => 'Fr. Selvanathan',
            'email' => 'selvanathansds@yahoo.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Sindus Kumar Nayak
        DB::table('users')->insert([
            'name' => 'Fr. Sindus Kumar Nayak',
            'email' => 'nayaksinduskumarsds15@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Starlight Khongsit
        DB::table('users')->insert([
            'name' => 'Fr. Starlight Khongsit',
            'email' => 'starlight.khongsit@mailsds.org',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Stephen Louis
        DB::table('users')->insert([
            'name' => 'Fr. Stephen Louis',
            'email' => 'stephenlouissds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Stephen Raj
        DB::table('users')->insert([
            'name' => 'Fr. Stephen Raj',
            'email' => 'stephenrksds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Sunil Thomas K
        DB::table('users')->insert([
            'name' => 'Fr. Sunil Thomas K',
            'email' => 'sunil.thomas@mailsds.org',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Susairaj Antonysamy
        DB::table('users')->insert([
            'name' => 'Fr. Susairaj Antonysamy',
            'email' => 'susairaj2@gamil.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Velpuri Srinu Babu
        DB::table('users')->insert([
            'name' => 'Fr. Velpuri Srinu Babu',
            'email' => 'vsrinusds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Vimal Raj
        DB::table('users')->insert([
            'name' => 'Fr. Vimal Raj',
            'email' => 'vimalraj.amal@mailsds.org',
            'password' => Hash::make('admin@123'),
        ]);

        // Fr. Vinoy Joseph Thottakkara
        DB::table('users')->insert([
            'name' => 'Fr. Vinoy Joseph Thottakkara',
            'email' => 'vinoysds@yahoo.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Cl. Jeberius Paul Tirkey
        DB::table('users')->insert([
            'name' => 'Cl. Jeberius Paul Tirkey',
            'email' => 'jebriuspaultirkey@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Cl. Karnelius Murmu
        DB::table('users')->insert([
            'name' => 'Cl. Karnelius Murmu',
            'email' => 'korneliusmurmu1@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Cl. Meshelmon Suja
        DB::table('users')->insert([
            'name' => 'Cl. Meshelmon Suja',
            'email' => 'bahruidsuja@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Cl. Niju Josey
        DB::table('users')->insert([
            'name' => 'Cl. Niju Josey',
            'email' => 'nijujoseysds@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

                                        

        
    }
}
