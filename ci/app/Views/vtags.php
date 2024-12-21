<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMC 22 Tags</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/paper.css')?>">
     <!-- Set page size here: A5, A4, A4 landscape, letter, legal or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: A4 }</style>
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
    </style>
</head>
<body class="A4">

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
        $audience = '';
        if($type == 'l'){
            $audience = 'LECTURER';
        }else if($type == 'v'){
            $audience = 'VISITOR';
        }else if($type == 'o'){
            $audience = 'OFFICIAL';
        }
        $counter = 1;
            echo"<div class='container sheet'>";

        foreach ($del as $key => $de) {
            if($de == []){
                $x= 9;
            }else{
            if ($counter == 12) {
                $counter = 0;
                echo"
    <div class='card'>
        <div class='center logo'>
            <img src='assets/logo.png' alt='' width='50mm'>
            <h2 class='m-0'>PMC</h2>
            <small>https://camp.phfogun.org.ng</small>
        </div>
        <br>
        <br>
        <div style='height: 10mm; width: 43mm; background-color: #daa'></div>
        <div class='center mt-1'>
            <h1 style='font-family: consolas; font-size: 2.5rem;' class='m-0'>".$audience."<br>".ib($de)."</h1>

        <div style='height: 5mm; width: 43mm; background-color: #480'></div>
        <br>
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
            <h2 class='m-0'>PMC</h2>
            <small>https://camp.phfogun.org.ng</small>
        </div>
        <br>
        <br>
        <div style='height: 10mm; width: 43mm; background-color: #daa'></div>
        <div class='center mt-1'>
            <h1 style='font-family: consolas; font-size: 2.5rem;' class='m-0'>".$audience."<br>".ib($de)."</h1>

        <div style='height: 5mm; width: 43mm; background-color: #480'></div>
        <br>
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