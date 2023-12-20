<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMC Official Tags</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/paper.css')?>">
     <!-- Set page size here: A5, C5, C5 landscape, letter, legal or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: C5 }</style>
    <style>
        body{
            font-family: 'Tahoma';
        }
        .container{
            display: flex;
            flex-direction:row;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-between;
            align-items: center;
        }
        .card{
            height: 88mm;
            width: 44mm;
            background-color: #fff;
            border: 2px #000 solid;
            padding: 1mm 3mm;
            margin: 0;
            margin-top: 15mm;
            margin-left: 5mm;
            margin-right: 5mm;
        }
        .center{
            text-align: center;
        }
        .logo{
            line-height: 0.99rem;
        }
        .m-0{
            margin: 0;
        }
        .mt-1{
            margin-top: 3px;
        }
        .mt-2{
            margin-top: 6px;
        }
    </style>
</head>
<body class="C5">

    <?php
        function ab($val){
            return strtoupper(substr($val,0,1));
        }
        function category($acr){
            if($acr == 'jsec'){
                return "Junior Secondary";
            }else if($acr == 'ssec'){
                return "Senior Secondary";
            }else if($acr == 'primary'){
                return "Primary School";
            }else if($acr == 'hi' || $acr == 'Undergraduate'){
                return "Undergraduate";
            }else if($acr == 'sch_leaver' || $acr == 'Post/Secondary_Sch_Student'){
                return "Post Secondary School";
            }else if ($acr == 'Working_Class' || $acr == 'Workers'){
                return "Working Class";
            }
        }
        function ib($val){
            if ($val > 0 && $val < 10) {
                return '00'.$val;
            }elseif ($val > 10 && $val < 100) {
                return '0'.$val;
            }else{
                return $val;
            }
        }

        $counter = 1;
            echo"<div class='container sheet'>";
            // dd($del);
        foreach ($del as $key => $de) {
            // dd($de);
            if($de == []){
                $x= 9;
            }else{
            if ($counter == 2) {
                $counter = 0;
                echo"
    <div class='card'>
        <div class='center logo'>
            <img src='assets/logo.png' alt='' width='50mm'>
            <h2 class='m-0'>PMC '23</h2>
            <h2 class='mt-2' style='font-size:2rem;'>OFFICIAL</h2>
        </div>
        <div class='m-0'>
            <p class='m-0'>Name:</p>
            <h4 class='m-0'>".$de[0]['fname']." ".$de[0]['lname']."</h4>
        </div>
         <br>
        <div class='m-0'>
            <p class='m-0'>Local Branch & House:</p>
            <h4 class='m-0'>".$de[0]['lb']." || ".$de[0]['house']."</h4>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Department:</p>
            <h4 class='m-0'>".explode('||',$de[0]['school'])[1]."</h4>
        </div>
        <br>

        <div class='center logo mt-1'>
            <h1 style='font-family: consolas;' class='m-0'>PHF".ab($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id'])."</h1>
            <small style='font-size: 0.6rem;'>...returning to Allah with PURE HEART</small>
        </div>
    </div>

            </div>
                <div class='container sheet'>";
            }else{
                echo "
<div class='card'>
        <div class='center logo'>
            <img src='assets/logo.png' alt='' width='50mm'>
            <h2 class='m-0'>PMC '23</h2>
            <h2 class='mt-2' style='font-size:2rem;'>OFFICIAL</h2>
        </div>
        <div class='m-0'>
            <p class='m-0'>Name:</p>
            <h4 class='m-0'>".$de[0]['fname']." ".$de[0]['lname']."</h4>
        </div>
         <br>
        <div class='m-0'>
            <p class='m-0'>Local Branch & House:</p>
            <h4 class='m-0'>".$de[0]['lb']." || ".$de[0]['house']."</h4>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Department:</p>
            <h4 class='m-0'>".explode('||',$de[0]['school'])[1]."</h4>
        </div>
        <br>

        <div class='center logo mt-1'>
            <h1 style='font-family: consolas;' class='m-0'>PHF".ab($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id'])."</h1>
            <small style='font-size: 0.6rem;'>...returning to Allah with PURE HEART</small>
        </div>
    </div>

                ";
            }
            $counter++;
        }
    }
    echo"</div>";
    ?>


</body>
</html>