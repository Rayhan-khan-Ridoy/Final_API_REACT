<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\testMail;
use Illuminate\Support\Facades\Mail;


class mailController extends Controller
{
    public function sendMail(){
        $details = ["tittle"=>"__tittle__ridoyRayhan@khan__tittle",
                    "body"=>"....___body__test purpose___body__..."
                    ];
        //Mail::to(["kredoy416@gmail.com","tanvir.ahmed@aiub.edu"])->send(new testMail($details));
        Mail::to("kredoy416@gmail.com")->send(new testMail($details));
        return response()->json(["mail"=>"mail sent succesfully!"]);
        //return "mail sent succesfully!";
       
    }
    
}
