<?php
declare(strict_types=1);

namespace UnionFind;

require './vendor/autoload.php';

$vertices = [];
$edges = [];

$size = 200;

for ($i = 0; $i < $size; $i++) {
    $x = rand(0, 500);
    $y = rand(0,500);
    $vertices[] = new Vertex($i, $x, $y, $i);
}

$flipflop = [];

for ($i = 0; $i < $size; $i++) {
    $next = rand(0, $size-1);
    if (!(isset($flipflop[$next]) && $flipflop[$next] == $i) && $i != $next) {
        $flipflop[$i] = $next;
        $edges[] = new Edge($vertices[$i], $vertices[$next]);
    }
}

$vertexCollection = VertexCollection::fromArray($vertices);
$edgeCollection = EdgeCollection::fromArray($edges);

$graph = new Graph($vertexCollection, $edgeCollection);

$recursion = false;

try {

    $unionFind = new UnionFind($size);

    foreach ($graph->edges()->iterator() as $edge) {
        $x = $unionFind->find($edge->source()->id());
        $y = $unionFind->find($edge->destination()->id());

        if ($x == $y) {
            $recursion = true;
            break;
        }

        $unionFind->union($x, $y);
    }

}
catch(UnionFindException $exception) {
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Union Find</title>
    <script type="application/javascript" src="canvas.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" type="text/css" href="main.css?v=<?= time() ?>">
    <script type="application/javascript">
        function reload() {
            let timeout = 1000;
            let isGood = document.getElementById("isRecursion").innerText;
            if (isGood === 'true') {
                timeout = 500;
            }
            else {
                timeout = 5000;
            }
            setTimeout(function() {
                location.reload();
            }, timeout);
        }
    </script>
</head>
<body onload="reload()">
<h1>Union Find</h1>
<div id="info">
    <p>
        Vertices are randomly generated, and then each one is assigned a random Edge (connection to other Vertex).
        Then Union-Find is used to determine if a recursive path exists. With that many Vertices it is amazing that
        occasionally a pattern is created without a recursive path.
    </p>

    <p><strong><?= ($recursion) ? 'Uh oh! Recursion is reoccurring.' : 'You ah-ight!' ?></strong></p>

</div>
    <div id="isRecursion"><?= ($recursion) ? 'true' : 'false' ?></div>
    <div id="frame">
        <svg id="graph1" width="500" height="500">
            <?php foreach ($graph->vertices()->iterator() as $vertex) : ?>
                <circle cx="<?= $vertex->x(); ?>" cy="<?= $vertex->y(); ?>" r="4"
                        stroke="black" stroke-width="1" fill="yellow">
                </circle>
            <?php endforeach; ?>
            <?php foreach ($graph->edges()->iterator() as $edge) : ?>
                <line x1="<?= $edge->source()->x(); ?>" y1="<?= $edge->source()->y(); ?>"
                      x2="<?= $edge->destination()->x(); ?>" y2="<?= $edge->destination()->y(); ?>"
                      style="stroke:rgb(0,0,0); stroke-width:1">
                </line>
            <?php endforeach; ?>
        </svg>
    </div>
</body>
</html>




