<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WordsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request)
    {
        $text = $request->addText;
        $pattern = "/[!@#$%^&*()_+{}\/\\\|\]\[\"“”<>,.]+/";
        $text = mb_eregi_replace("/[`‘’]/", '\'', $text);
        $text = preg_replace("/[0-9.,]/", '', $text);

        $text = strtolower(
            mb_eregi_replace($pattern, "", $text)
        );

        $text = preg_replace('/[\n\t\r]/', ' ', $text);
        $words = explode(' ', $text);
        $added = 0;
        foreach ($words as $w) {
            $w = ltrim($w, '-');
            if ($w !== "" && $w !== " ") {
                if (DB::table('words')->insertOrIgnore(['value' => $w])) {
                    $added++;
                }
            }
        }
        return redirect('enter')->with('success', "Введено слов: " . count($words) . ". Добавлено слов: $added");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function check(Request $request) : JsonResponse
    {
        $words = Words::get(); // Get Objectlist of existed Words
        $words_array = [];
        // Objectlist to array : start
        foreach ($words as $w){
            $words_array[] = $w->value;
        }
        $newWordsArray = array_fill_keys($words_array, true);
        // Objectlist to array : end


        $text = $request->text;

        $paragraphs = explode("\n\n", $text);
        $final_ouput = "";
        foreach ($paragraphs as $p){
            $out_p = "";
            $words = explode(' ', $p);

            foreach ($words as $w){
                $for_check_word = strtolower(trim($w,"\"\,."));
                if(isset($newWordsArray[$for_check_word]) || is_numeric($w)){
                    $out_p .= "$w ";
                } else if(preg_match('/\d+/', $for_check_word)) {
                    $f = preg_replace('/\d+/', "", $for_check_word);
                    $f = trim($f, "-");
                    if(isset($newWordsArray[$f])){
                        $out_p .= "$f ";
                    } else{
                        $out_p .= "<span class='custom-danger-alert'>$f</span> ";
                    }
                }
                else{
                    $out_p .= "<span class='custom-danger-alert'>$w</span> ";
                }
            }
            $final_ouput .= "<p>$out_p</p>";
        }

        return response()->json(["text" => $final_ouput]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function wordList(Request $request): JsonResponse {
        $words = Words::query()->where("value", "like", "$request->word%")->get();
        return response()->json(["words" => $words]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delWord(Request $request)
    {
        Words::where("value", $request->del_word)->delete();
        return response()->json(["word" => $request->del_word]);
    }

    public function allWords(){
        return view("all-words", ["words" => Words::paginate(10000)]);
    }

}
