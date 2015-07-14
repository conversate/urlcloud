<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\File;
use App\Link;

class ApiController extends Controller
{

    private function genUrl($hashLength = 6) {

        $hash = bin2hex( openssl_random_pseudo_bytes($hashLength) );

        $blacklist = [
        'admin',
        'dashboard',
        'download',
        'docs',
        'flag',
        'image',
        'index',
        'login',
        'help',
        'news',
        'logs',
        'mobile',
        'password',
        'upload',
        'save',
        'users',
        'view'
        ];
        if( in_array($hash, $blacklist) )
            return $this->uri();
        else
            return $hash;
    }
    public function fileStore(Request $request) {

        $bytes = $request->file('laracloud');
        if ($bytes->isValid())
        {
            $f = []; // The non-SPLFileObject file array
            $f['hash'] = hash_file('sha512', $request->file('laracloud'));
            $f['ext']  = ($bytes->guessExtension() === null) ? 'txt' : $bytes->guessExtension();
            $f['file'] = $f['hash'].'.'.$f['ext'];

            // Check if file exists already. #storageSaver
            if( File::where('hash', '=', $f['hash'])->count() === 0 ) {
                $f['mime'] = $bytes->getClientMimeType();
                $f['size'] = $bytes->getClientSize();
                $f['name'] = $bytes->getClientOriginalName();
                $fileName = $f['file'];
                $destinationPath = storage_path().'/app/files';

                $request->file('laracloud')->move($destinationPath, $fileName);

                $file = new File;
                $file->hash = $f['hash'];
                $file->mime = $f['mime'];                
                $file->extension = $f['ext'];                
                $file->size = $f['size'];
                $file->metadata = json_encode([
                    'originalFileName'      => $f['name'],
                    'originalUploaderIp'    => \Request::ip(),
                    // Add addition metadatas
                    ]);
                $file->save();

            } else {

            }
            $url = $this->genUrl(3);
            $link = new Link;
            $link->hash = $f['hash'];
            $link->file = $f['file'];
            // FIXME: non-unique/race condtion bug. need to check if url is unique
            $link->uri = $url;
            $link->title = null;// e( $request->input('title') );
            $link->description = null;
            $link->is_public = true;
            $link->metadata = json_encode([
                'ip'            => \Request::ip(),
                'browser'       => null,//get_browser(null, true),
                'source'        => 'web',
            ]);
            $link->save();

            //$request->file('laracloud')->move($destinationPath, $fileName);
            return response()->json(
                [
                $f,
                $link,
                $url,
                $request->all()], 200, [], JSON_PRETTY_PRINT);
        }

    }

}
