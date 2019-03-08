<?php
declare(strict_types=1);

namespace UnionFind;

    require './vendor/autoload.php';

    $vertices = [];
    $edges = [];


    $size = (isset($_GET['c'])) ? intval($_GET['c']) : 8;

    for ($i = 0; $i < $size; $i++) {
        $x = rand(0, 500);
        $y = rand(0,500);
        $vertices[] = new Vertex($i, $x, $y, $i);
    }

    for ($i = 0; $i < $size; $i++) {
        $next = $i;
        while ($next++ < ($size - 1)) {
            $edges[] = new Edge($vertices[$i], $vertices[$next]);
        }
    }

    usort($edges, function($a, $b) {
        /** @var Edge $a */
        /** @var Edge $b */
        return $a->length() <=> $b->length();
    });


    $vertexCollection = VertexCollection::fromArray($vertices);
    $edgeCollection = EdgeCollection::fromArray($edges);

    $graph = new Graph($vertexCollection, $edgeCollection);

    $minimumSpan = [];

    try {

        $unionFind = new UnionFind($size);

        foreach ($graph->edges()->iterator() as $edge) {
            $x = $unionFind->find($edge->source()->id());
            $y = $unionFind->find($edge->destination()->id());

            if ($x == $y) {
                continue;
            }

            $minimumSpan[] = $edge;

            $unionFind->union($x, $y);

            if ($unionFind->size() == 1) {
                break;
            }
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
    <title>Union Find - Kruskal</title>
    <link rel="stylesheet" type="text/css" href="main.css?v=<?= time() ?>">
    <script type="application/javascript">
        function init() {
            setTimeout(function() {
                document.getElementById("graph1").style.opacity = '0';
            }, 1000);
            let verticesCount = document.getElementById("vertices-count");
            verticesCount.addEventListener('change', function() {
                window.location.href = '/index.php?c=' + verticesCount.value;
            });
        }
    </script>
</head>
<body onload="init()">
<h1>Kruskal's Minimum Spanning Tree</h1>
<h3>Using Union-Find</h3>

<div id="info">
    <p>
        Vertices are randomly generated, and then all Edges (connections to other Vertices) are calculated.
        Then Union-Find is used to quickly determine a Minimum Spanning Tree.
    </p>
    <p>
        <em>The finished graph on the right is to show that the calculations are already complete on load.</em>
    </p>
</div>

<label for="vertices-count">Vertex Count </label>
<select id="vertices-count">
    <option value="8"<?= ($size == 8) ? 'selected' : '' ?>>8</option>
    <option value="16" <?= ($size == 16) ? 'selected' : '' ?>>16</option>
    <option value="32"<?= ($size == 32) ? 'selected' : '' ?>>32</option>
    <option value="64"<?= ($size == 64) ? 'selected' : '' ?>>64</option>
    <option value="128"<?= ($size == 128) ? 'selected' : '' ?>>128</option>
    <option value="256"<?= ($size == 256) ? 'selected' : '' ?>>256</option>
</select>

<p><strong>Edge Count: </strong><?= count($edges) ?></p>

<div id="frame">
    <svg id="graph1" width="500" height="500">
        <?php foreach ($graph->edges()->iterator() as $edge) : ?>
            <line x1="<?= $edge->source()->x(); ?>" y1="<?= $edge->source()->y(); ?>"
                  x2="<?= $edge->destination()->x(); ?>" y2="<?= $edge->destination()->y(); ?>"
                  style="stroke:rgb(0,0,0); stroke-width:1">
            </line>
        <?php endforeach; ?>
        <?php foreach ($graph->vertices()->iterator() as $vertex) : ?>
            <circle cx="<?= $vertex->x(); ?>" cy="<?= $vertex->y(); ?>" r="4"
                    stroke="black" stroke-width="1" fill="yellow">
            </circle>
        <?php endforeach; ?>
    </svg>
    <svg id="graph2" width="500" height="500">
        <?php foreach ($minimumSpan as $edge) : ?>
            <line x1="<?= $edge->source()->x(); ?>" y1="<?= $edge->source()->y(); ?>"
                  x2="<?= $edge->destination()->x(); ?>" y2="<?= $edge->destination()->y(); ?>"
                  style="stroke:rgb(0,0,0); stroke-width:1">
            </line>
        <?php endforeach; ?>
        <?php foreach ($graph->vertices()->iterator() as $vertex) : ?>
            <circle cx="<?= $vertex->x(); ?>" cy="<?= $vertex->y(); ?>" r="4"
                    stroke="black" stroke-width="1" fill="yellow">
            </circle>
        <?php endforeach; ?>
    </svg>
    <svg id="graph3" width="500" height="500">
        <?php foreach ($minimumSpan as $edge) : ?>
            <line x1="<?= $edge->source()->x(); ?>" y1="<?= $edge->source()->y(); ?>"
                  x2="<?= $edge->destination()->x(); ?>" y2="<?= $edge->destination()->y(); ?>"
                  style="stroke:rgb(0,0,0); stroke-width:1">
            </line>
        <?php endforeach; ?>
        <?php foreach ($graph->vertices()->iterator() as $vertex) : ?>
            <circle cx="<?= $vertex->x(); ?>" cy="<?= $vertex->y(); ?>" r="4"
                    stroke="black" stroke-width="1" fill="yellow">
            </circle>
        <?php endforeach; ?>
    </svg>
</div>
</body>
</html>




