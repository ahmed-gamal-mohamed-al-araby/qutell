<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Surah;
use App\Models\SurahPage;
use App\Models\Verse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class testController extends Controller
{
//    public function TestPage()
//    {
//
////        return Page::with(['surah_pages' => function($q) {
////            return $q->select('id', 'page_id' ,'surah_id','first_ayah','last_ayah','juz_number','hizb_number');
////        }])->select('id')->get();
//
//
////      return  $itemOrders = DB::table('pages')
////            ->join('surah_pages', 'pages.id', '=', 'surah_pages.page_id')
////            ->join('surahs', 'surah_pages.surah_id', '=', 'surahs.id')
////            ->select('pages.id', 'surah_pages.first_ayah' , 'surah_pages.last_ayah' , 'surah_pages.juz_number' , 'surah_pages.hizb_number' , 'surahs.total_verses','surahs.number_surah')
////            ->get();
//
////
////        $data = [];
////        for ($page = 1; $page <= 114; $page++) {
////            $json_data = file_get_contents(asset('quran_text/pages/'.$page.'.json'));
////            $json_data = json_decode($json_data);
////            $filePath = public_path('quran_text/pages/'.($page+1).'.json');
////            $data[$page]['first_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
////
////            if (file_exists($filePath)) {
////                $json_data2 = file_get_contents(asset('quran_text/pages/'.($page+1).'.json'));
////                $json_data2 = json_decode($json_data2);
////                if( $json_data->verses[0]->page_number != $json_data2->verses[0]->page_number) {
////                    $data[$page]['last_page'] = isset($json_data2->verses) ? $json_data2->verses[0]->page_number - 1 : null;
////                } else {
////                    $data[$page]['last_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
////                }
////            } else {
////                $data[$page]['last_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
////            }
////            $data[$page]['number_surah'] = $page;
////            $data[$page]['total_page'] = ($data[$page]['last_page'] - $data[$page]['first_page']) + 1;
////            $data[$page]['total_verses'] = isset($json_data->pagination) ? $json_data->pagination->total_records : 0;
////        }
////
////        for ($page = 1; $page <= 114; $page++) {
////            $json_data = file_get_contents(asset('quran_text/surah/' . $page . '.json'));
////            $json_data = json_decode($json_data);
////            $data[$page]['surah'] = $json_data->verse;
////        }
////
////
////        foreach ($data as $key => $value) {
////            $obj = (object) $value;
////            $arrayOfObjects[] = $obj;
////        }
////        return $arrayOfObjects;
//
////        for ($page = 1; $page <= 604; $page++) {
////            $json_data = file_get_contents(asset('quran_text/sub_page/page_' . $page . '.json'));
////            $json_data = json_decode($json_data);
////
////            foreach ( $json_data->verses as $index => $vers) {
////                $parts = explode(':',$vers->verse_key);
////                $data2[$page][$parts[0]][] = $vers->verse_number;
////                $data2[$page]['juz_number'] = $vers->juz_number;
////                $data2[$page]['hizb_number'] = $vers->hizb_number;
////            }
////        }
////        foreach ($data2 as $index => $values) {
////            foreach ($values as $key => $value) {
////                if (is_array($value)) {
////                    SurahPage::create([
////                        'uuid' => '8e3-dde4-48cc-'.$index.'a90-c80a6'.$index.'2d9bd',
////                        'page_id' => $index,
////                        'surah_id' => $key,
////                        'first_ayah' => reset($value),
////                        'last_ayah' => end($value),
////                        'juz_number' => $values['juz_number'],
////                        'hizb_number' => $values['hizb_number'],
////                    ]);
////                }
////            }
////        }
////        return 2;
//        $json_data = file_get_contents(asset('quran_text/surah/12.json'));
//        $json_data = json_decode($json_data);
//        return view('quran.page',compact('json_data'));

    // verse English

//        $json_data = file_get_contents(asset('quran_text/en.json'));
//        $json_data = json_decode($json_data);
//
//        foreach ($json_data->data->surahs as $obj) {
//        $all[$obj->number][] = $obj->ayahs;
//        }
//
//        foreach ($all as $key => $value) {
//            $data[] = $value;
//        }
//        $i = 1;
//        foreach ($data as $key => $na) {
//            foreach ($na as $obj_name) {
//                $n = 2;
//                foreach ($obj_name as $index => $ayah) {
//                    $count = Verse::where('surah_id',$i)->count();
//                    $verse = Verse::where('surah_id',$i)->orderBy('id','DESC')->latest()->first()->id;
//                    $id = ($verse - $count) + $n;
//                    Verse::where('surah_id',$i)->where('id',$id)->update([
//                        'verse_en' => $ayah->text,
//                        'sajda' => $ayah->sajda == true ? 1 : 0,
//                    ]);
//                    ++$n;
//                }
//            }
//            ++$i;
//        }
//    }
    public function TestPage()
    {
      return  $pages = SurahPage::with(['ayahs' => function ($query) use ($pageIds) {
            foreach ($pageIds as $id => $values) {
                $query->orWhere(function ($q) use ($values) {
                    $q->where('id', '>=', $values['first_ayah'])
                        ->where('id', '<=', $values['last_ayah']);
                });
            }
        }])->paginate(10);
        return view('quran.page',compact('data'));
    }
}
