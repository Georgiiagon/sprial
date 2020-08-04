<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->input('size', 10);
        $i = '*';
        $cycles = $size;
        $spiral = [];

        for($row = 0; $cycles > 0; $row = $row + 2) {

            for ($column = $row; $column <= $row + $cycles - 1; $column++) {
                $spiral[$row][$column] = $i;
            }

            $cycles--;

            for($column = $row + 1; $column <= $row + $cycles; $column++) {
                $spiral[$column][$size - $row - 1] = $i;
            }

            $cycles--;

            for ($column = $cycles; $column >= 1; $column--) {
                $spiral[$size - $row - 1][$column + $row] = $i;
            }

            $cycles--;

            for ($column = $cycles; $column >= 1; $column--) {
                $spiral[$column + $row + 1][$row + 1] = $i;
            }

            $cycles--;
        }

//        dd($spiral);

        $temp = '';
        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size; $j++) {
                if (!isset($spiral[$i][$j])) {
                    $spiral[$i][$j] = ' ';
                }
                $temp .= $spiral[$i][$j] . ' ';

                if ($j == $size - 1) {
//                    dump($temp);
                    $temp .= PHP_EOL;
                }
            }
        }

//        dd($temp);

        return view('welcome', [
            'spiral' => $temp
        ]);
    }


}
