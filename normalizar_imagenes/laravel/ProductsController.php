<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Product;
use Image;

class ProductsController extends Controller{


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
	$producto = new Product();
	$producto->product_name = $request->input('titulo');
	$producto->description = $request->input('descripcion');
	$producto->quantity = $request->input('cantidad');       
	$producto->price = $request->input('precio');
	$producto->is_new = $request->input('condicion');
	$producto->marca = $request->input('marca');
	$producto->modelo = $request->input('modelo');
	$producto->origen = $request->input('origen');
	$producto->categoria_id = $request->input('categoria');
    $producto->seller_id = Auth::id();
    
    $path_storage = storage_path().'/app/public/images/';
    $thumb_storage = storage_path().'/app/public/thumbnails/';
    $canvas = Image::canvas(800,800, '#fff');

    if ($request->file('imagen1') != null) {
        $imagen1 = $request->file('imagen1');
        $img = Image::make($imagen1->getPathName());
        if ($img->width() > $img->height()) {
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($img, 'top-left', 0, intval((800 - $img->height())/2));
        }
        if ($img->height() > $img->width() ) {
            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($img, 'top-left',intval((800 - $img->width())/2) ,0 );
        }

        if ($img->width() == $img->height()) {
             $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($img, 'top-left', 0,0);
        }
        
        
        $img_name = time().$imagen1->getClientOriginalName();	
        $canvas->save($path_storage.$img_name);
        $canvas->resize(100,100);
        $canvas->save($thumb_storage.'thumb_'.$img_name);
        $producto->image1 = '/images/'.$img_name;    
        $producto->thumbnail_1 = '/thumbnails/thumb_'.$img_name;     
    } 
// -------------------------imagen2 
     $canvas2 = Image::canvas(800,800, '#fff');
    if ($request->file('imagen2') != null) {       
        $imagen2 = $request->file('imagen2');
        $img2 = Image::make($imagen2->getPathName());
        if ($img2->width() > $img2->height()) {
            $img2->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas2->insert($img2, 'top-left', 0, intval((800 - $img2->height())/2));
        }
        if ($img2->height() > $img2->width() ) {
            $img2->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas2->insert($img2, 'top-left',intval((800 - $img2->width())/2),0);
        }
        if ($img2->width() == $img2->height()) {
            $img2->resize(800, null, function ($constraint) {
               $constraint->aspectRatio();
           });
           $canvas2->insert($img2, 'top-left', 0,0);
       }       
        
         
       $img_name2 = time().$imagen2->getClientOriginalName();	
       $canvas2->save($path_storage.$img_name2);
       $canvas2->resize(100,100);
       $canvas2->save($thumb_storage.'thumb_'.$img_name2);
       $producto->image2 = '/images/'.$img_name2;    
       $producto->thumbnail_2 = '/thumbnails/thumb_'.$img_name2;     
    } 	
	
	$producto->save();
	
	return redirect('/');
    }
}