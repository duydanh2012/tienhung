<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(10);

        $title = 'Liên hệ';

        return view('admin.contacts.list')->with(compact('contacts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Contact::find($id);

        return view('admin.contacts.form')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Contact::find($id);

        $data->fill($request->input());
        $data->save();

        $datas = [
            'name' => $data->name,
            'subject' => $data->subject,
            'messageContact' => $data->message,
            'reply'          => $data->reply,
        ];

        Mail::send('public.email.reply-contact', $datas, function($mail) use ($data){
            $mail->from('abc2012199@gmail.com', 'Support Portal');
            $mail->to($data->email, $data->name)->subject('Liên hệ');
        });

        return redirect()->back()->with('alert_success', 'Trả lời thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Contact::destroy($id);
        
        return redirect(route('contact.index'))->with('alert_success', 'Xóa thành công!');
    }

    public function search(Request $request)
    {
        $rq = $request->input('q');
        $contacts = Contact::where('id', 'LIKE', '%' . $rq . '%')
                        ->orWhere('name', 'LIKE', '%' . $rq . '%')
                        ->orWhere('subject', 'LIKE', '%' . $rq . '%')
                        ->paginate(10);
        
        $title = 'Tìm kiếm với từ khóa ' . $rq;                

        return view('admin.contacts.list')->with(compact('contacts', 'title'));
    }
}
