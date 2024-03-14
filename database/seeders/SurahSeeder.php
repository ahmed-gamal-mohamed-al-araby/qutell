<?php

namespace Database\Seeders;

use App\Models\Surah;
use App\Models\SurahPage;
use App\Models\Verse;
use Illuminate\Database\Seeder;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $data = [];
//        for ($page = 1; $page <= 114; $page++) {
//            $json_data = file_get_contents(asset('quran/public/quran_text/pages/'.$page.'.json'));
//            $json_data = json_decode($json_data);
//            $filePath = public_path('quran/quran_text/pages/'.($page+1).'.json');
//            $data[$page]['first_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
//
//            if (file_exists($filePath)) {
//                $json_data2 = file_get_contents(asset('quran/public/quran_text/pages/'.($page+1).'.json'));
//                $json_data2 = json_decode($json_data2);
//                if( $json_data->verses[0]->page_number != $json_data2->verses[0]->page_number) {
//                    $data[$page]['last_page'] = isset($json_data2->verses) ? $json_data2->verses[0]->page_number - 1 : null;
//                } else {
//                    $data[$page]['last_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
//                }
//            } else {
//                $data[$page]['last_page'] = isset($json_data->verses) ? $json_data->verses[0]->page_number : null;
//            }
//            $data[$page]['number_surah'] = $page;
//            $data[$page]['total_page'] = ($data[$page]['last_page'] - $data[$page]['first_page']) + 1;
//            $data[$page]['total_verses'] = isset($json_data->pagination) ? $json_data->pagination->total_records : 0;
//        }
//
//        for ($page = 1; $page <= 114; $page++) {
//            $json_data = file_get_contents(asset('quran/public/quran_text/surah/' . $page . '.json'));
//            $json_data = json_decode($json_data);
//            $data[$page]['surah'] = $json_data->verse;
//        }
//
//
//        foreach ($data as $key => $value) {
//            $obj = (object) $value;
//            $arrayOfObjects[] = $obj;
//        }
//
//        foreach ($arrayOfObjects as $key => $obj) {
//         $surah = Surah::create([
//                'uuid' => '8c2e3-dde4-48cc-'.++$key.'a90-c80a6'.++$key.'2d9bd',
//                'first_page' => $obj->first_page,
//                'last_page' => $obj->last_page,
//                'number_surah' => $obj->number_surah,
//                'total_page' => $obj->total_page,
//                'total_verses' => $obj->total_verses,
//            ]);
//        $i = 1;
//         foreach ($obj->surah as $index => $verse){
//
//             Verse::create([
//                 'uuid' => '8e3-dde4-48cc-'.$i++.'a90-c80a6'.$i++.'2d9bd',
//                 'verse' => $verse,
//                 'surah_id' => $surah->id
//             ]);
//         }
//        }

        for ($page = 1; $page <= 604; $page++) {
            $json_data = file_get_contents(asset('quran/public/quran_text/sub_page/page_' . $page . '.json'));
            $json_data = json_decode($json_data);
            foreach ( $json_data->verses as $vers) {
                $parts = explode(':',$vers->verse_key);
                $data2[$page]['surah'][$parts[0]][] = $vers->verse_number;
                $data2[$page]['juz_number'] = $vers->juz_number;
                $data2[$page]['hizb_number'] = $vers->hizb_number;
            }
        }
        $i = 1;
        foreach ($data2 as $index => $obj) {
            foreach ($obj as $surah => $verse) {
                $first = reset($verse);
                $last = end($verse);
                $surah_id = $surah;

            }
            SurahPage::create([
                'uuid' => '8e3-dde4-48cc-'.$i++.'a90-c80a6'.$i++.'2d9bd',
                'page_id' => $index,
                'surah_id' => $surah_id,
                'first_ayah' => $first,
                'last_ayah' => $last,
                'juz_number' => $obj['juz_number'],
                'hizb_number' => $obj['hizb_number'],
            ]);
        }

    }
}
