<html>

<head>
    <title> Actividad 3 </title>
</head>

<body>
    <form action="actividad3.php" method="POST">
        Introduce tu nombre: <br>
        <input type="text" name="nombre" required>
        <br><br>
        Selecciona tu carrera: <br>
        <INPUT TYPE="radio" NAME="voto" VALUE="PRI" CHECKED>PRI
        <INPUT TYPE="radio" NAME="voto" VALUE="PAN">PAN
        <INPUT TYPE="radio" NAME="voto" VALUE="PRD">PRD
        <INPUT TYPE="radio" NAME="voto" VALUE="Voto nulo">Voto nulo
        <br><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
    <?PHP
    include "libchart\libchart\classes/libchart.php";
    $chart = new PieChart(600,170);
    $dataset = new XYDataset();

    $nombreUsuario = $_POST['nombre'];
    $voto = $_POST['voto'];

    $file = "votantes.txt";
    $fp = fopen($file, "a+");
    
    $archivo = $nombreUsuario." ".$voto;
    //echo $archivo;
    while(!feof($fp)){

    }
    fwrite($fp, $archivo.PHP_EOL);
    fclose($fp);

    $votos = [0,0,0,0];
    
    $fp = fopen($file, "r");
    while(!feof($fp)){
        fscanf($fp, "%s\t%s", $nomb, $vo);
        switch($vo){
            case "PRI":
                $votos[0] = $votos[0] + 1;
                echo $votos[0];
                break;
            case "PAN":
                $votos[1] = $votos[1] + 1;
                echo $votos[1];
                break;
            case "PRD":
                $votos[2] = $votos[2] + 1;
                echo $votos[2];
                break;
            default:
                $votos[3] = $votos[3] + 1;
                echo $votos[3];

        }

    }

    $dataset->addPoint(new Point("PRI", $votos[0]));
    $dataset->addPoint(new Point("PAN", $votos[1]));
    $dataset->addPoint(new Point("PRD", $votos[2])); 
    $dataset->addPoint(new Point("Nulo", $votos[3])); 

    $chart->setDataSet($dataset);

    fclose($fp);

    $chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));
    $chart->setTitle("Votos");
    $chart->render("libchart/demo/generated/demo1.png");

    ?>
    <img src="libchart\demo\generated\demo1.png">
</body>
</html>