<?php
namespace App\Helpers;

class Helper{
    public static function regioes($estados){
        //Dessa maneira, se diminui o numero de
        //iterações sobre o vetor estados
        $c1 = 0;
        $r1 = [];
        $c2 = 0;
        $r2 = [];
        $c3 = 0;
        $r3 = [];
        $c4 = 0;
        $r4 = [];
        $c5 = 0;
        $r5 = [];
        foreach ($estados as $estado){
            if($estado->regiao == 1){
                $r1[$c1] = $estado;
                $c1++;
            }
            elseif($estado->regiao == 2){
                $r2[$c2] = $estado;
                $c2++;
            }
            elseif($estado->regiao == 3){
                $r3[$c3] = $estado;
                $c3++;
            }
            elseif($estado->regiao == 4){
                $r4[$c4] = $estado;
                $c4++;
            }
            elseif($estado->regiao == 5){
                $r5[$c5] = $estado;
                $c5++;
            }
        }

        return [$r1,$r2,$r3,$r4,$r5];
    }


}