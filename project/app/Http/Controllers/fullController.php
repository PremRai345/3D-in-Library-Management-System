<?php

namespace App\Http\Controllers;
use Illuminate\Support\stroage;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class fullController extends Controller
{
    public function welcomes(Request $request){
            $search = $request['search'] ?? "";
            if($search != ""){
                $books = Book::where('BookName','LIKE',"%$search%")->get();
            }
            else{
                $books = Book::all();
            }
            return view('welcome',compact('books','search'));
        
    }
    public function openpolicy(){
        return view('privacyandpolicy');
    }
    public function open3dbook(){
        return view('3dbook');
    }
    public function getUser(){
        $users = User::all();
        $books = Book::all();
        return view('admin',compact('users','books'));
    }
    public function openForm(){
        $data = new Book();
        $title = 'Add Book';
        $link = 'storeBook';
        return view('storeBook',compact('data','title','link'));
    }
    public function openAvatar(){
        return view('avatar');
    }
    public function openDashboard(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $books = Book::where('BookName','LIKE',"%$search%")->get();
        }
        else{
            $books = Book::all();
        }
        return view('dashboard',compact('books','search'));
    }
    public function AddBook(Request $request){
        $request->validate(
            [
                'bookname' => 'required',
                'bookimage' => 'required',
                'authorname'=>'required',
                'bookdes' => 'required'
            ]
            );
            $fileName = time()."Book.".$request->file('bookimage')->getClientOriginalExtension();
            $request->file('bookimage')->move('upload',$fileName);
            $pdfName = time()."Book.".$request->file('bookpdf')->getClientOriginalExtension();
            $request->file('bookpdf')->move('upload',$pdfName);
            $book = new Book();
        $book->BookName = $request['bookname'];
        $book->AuthorName = $request['authorname'];
        $book->BookDescription = $request['bookdes'];
        $book->BookImage = $fileName;
        $book->BookPdf = $pdfName;
        $book->save();
        return redirect('admin');
    }
    public function delBook($id){
        Book::find($id)->delete();
        return redirect()->back();
    }
    public function downloadfile(Request $request, $file){
        return response()->download(public_path('upload/'.$file));
    }
    public function viewfile($id){
        $data = Book::find($id);
        return view('viewfile',compact('data'));
    }
    public function editBook($id){
        $data = Book::find($id);
        $title = "Edit Book";
        $link = url('/updateBook').'/'.$id;
        return view('storeBook',compact('data','title','link'));
    }
    public function resuBook(Request $request, $id){
        $book = Book::find($id);
        $request->validate(
            [
                'bookname' => 'required',
                'bookimage' => 'required',
                'authorname'=>'required',
                'bookdes' => 'required'
            ]
            );
            $fileName = time()."Book.".$request->file('bookimage')->getClientOriginalExtension();
            $request->file('bookimage')->move('upload',$fileName);
            $pdfName = time()."Book.".$request->file('bookpdf')->getClientOriginalExtension();
            $request->file('bookpdf')->move('upload',$pdfName);
        $book->BookName = $request['bookname'];
        $book->AuthorName = $request['authorname'];
        $book->BookDescription = $request['bookdes'];
        $book->BookImage = $fileName;
        $book->BookPdf = $pdfName;
        $book->save();
        return redirect('admin');
    }
}
