<!DOCTYPE html>
<html>

<head>
  <title>Splay Tree Animation by Om Patel</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <style type="text/css">
    .container {
      width: 100%;
      height: 450px;
      overflow: auto;
      position: relative;
    }

    .canvas {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
    }
  </style>



  <link href="jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body onload="draw()" onresize="draw()">

  <div class="row">

    <div class="col-lg-6">
      <div class="card mx-2 mt-2">
        <div class="card-header bg-secondary text-white">
          <h3 class="card-title text-center">Om Patel</h3>
        </div>
        <div class="card-body">
          <p class="card-text">Roll No: 21BCE519</p>
          <p class="card-text">Branch: Computer Science Engineering</p>
          <p class="card-text">College: Nirma University</p>
        </div>
      </div>

    </div>




  </div>

  <div class="row">

    <div class="col-6">
      <div class="card mt-2 ms-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-header bg-warning">
          <h3 class="card-title text-white text-center">TREE VISUALIZER</h3>
        </div>

        <div class="card-body container" id="myDiv">
          <canvas id="canvas" width="10000" height="10000"></canvas>
        </div>

      </div>
    </div>

    <div class="col-6">

      <div class="card mt-2 ms-2 me-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-header bg-warning">
          <h3 class="card-title text-white text-center">TREE OPERATIONS</h3>
        </div>


        <br>
        <br>
        <div class="input-group">
          <span class="input-group-text">Enter key</span>
          <input type="text" id="value" class="form-control" placeholder="key">
        </div>

        <br>
        <div class="row">

          <div class="col-lg-12 text-center">
            <button style=" width:100%;" type="button" class="btn btn-dark" onclick="search()">Search</button>
          </div>

          <div class="col-lg-12 text-center mt-2">
            <button style=" width:100%;" type="button" class="btn btn-dark" onclick="insert()">Insert</button>
          </div>

          <div class="col-lg-12 text-center mt-2">
            <button style=" width:100%;" type="button" class="btn btn-dark" onclick="remove1()">Remove</button>
          </div>


        </div>

      </div>

    </div>

  </div>

  <?php

  include 'ruf.html';

  ?>
</body>


<script async src="https://www.googletagmanager.com/gtag/js?id=UA-89940905-27"></script>
<script src="jquery-1.7.2.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
<script src="jquery.alerts.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments)
  };
  gtag('js', new Date());
  gtag('config', 'UA-89940905-27');
</script>

<script type="text/javascript" src="../logging.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="BST.js"></script>
<script src="SplayTree.js"></script>
<script>
  tree = new SplayTree();
  tree.insert(50);
  tree.insert(20);
  tree.insert(30);
  vGap = 40;
  radius = 20;

  function draw() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext("2d");
    const myDiv = document.getElementById("myDiv");

    const container = document.querySelector('.container');
    container.scrollTop = (canvas.offsetHeight - container.offsetHeight) / 5;
    container.scrollLeft = (canvas.offsetWidth - container.offsetWidth) / 5;
    const {
      width,
      height
    } = container.getBoundingClientRect();

    canvas.width = width * 10;
    canvas.height = height * 10;


    context.clearRect(0, 0, canvas.width, canvas.height);

    context.font = "14px sans-serif";
    context.strokeStyle = "#100";

    if (tree.isEmpty()) {
      context.fillText("tree is empty", canvas.width / 2 - 50, 15);
    } else {
      x = (container.scrollLeft + container.offsetWidth / 2) - 20;
      y = container.scrollTop + container.offsetHeight / 2 - 60;

      drawTree(context, x, y, radius, tree.root, canvas.width / 40);
    }

    context.stroke();
  }

  function drawTree(context, x, y, radius, root, hGap) {
    if ((root.element + "").length == 1)
      context.fillText(root.element + "", x - 3, y + 5);
    else if ((root.element + "").length == 2)
      context.fillText(root.element + "", x - 8, y + 5);
    else if ((root.element + "").length == 3)
      context.fillText(root.element + "", x - 12, y + 5);
    else if ((root.element + "").length == 4)
      context.fillText(root.element + "", x - 16, y + 5);
    else
      context.fillText(root.element + "", x - 8, y + 5);

    context.arc(x, y, radius, 0, Math.PI * 2, false);

    if (root.left != null) {
      connectTwoCircles(context, x, y, x - hGap, y + vGap);
      context.moveTo(x - hGap + radius, y + vGap);
      drawTree(context, x - hGap, y + vGap, radius, root.left, hGap / 2);
    }

    if (root.right != null) {
      connectTwoCircles(context, x, y, x + hGap, y + vGap);
      context.moveTo(x + hGap + radius, y + vGap);
      drawTree(context, x + hGap, y + vGap, radius, root.right, hGap / 2);
    }
  }

  // Connect two circles centered at (x1, y1) and (x2, y2) 
  function connectTwoCircles(context, x1, y1, x2, y2) {
    var d = Math.sqrt(vGap * vGap + (x2 - x1) * (x2 - x1));
    var x11 = x1 - radius * (x1 - x2) / d;
    var y11 = y1 - radius * (y1 - y2) / d;
    var x21 = x2 + radius * (x1 - x2) / d;
    var y21 = y2 + radius * (y1 - y2) / d;
    context.moveTo(x11, y11);
    context.lineTo(x21, y21);
  }

  function remove1() {
    if (tree.isEmpty()) {
      jAlert("The tree is empty");
    } else {
      var value = document.getElementById('value').value.trim();
      if (value == "") {
        jAlert("no key entered");
      } else if (tree.search(parseInt(value))) {
        tree.delete(parseInt(value));
        draw();
      } else {
        jAlert("key " + value + " is not in the tree");
      }
    }
  }

  function insert() {
    var value = document.getElementById('value').value.trim();
    if (value == "") {
      jAlert("no key entered");
    } else if (tree.search(parseInt(value))) {
      showAlert("Alert", "key " + value + " is already in the tree");
    } else {
      tree.insert(parseInt(value));
      draw();
    }
  }

  function drawArrowLine(context, x1, y1, x2, y2) {
    context.moveTo(x1, y1);
    context.lineTo(x2, y2);


    var slope = (y1 - y2) / (x1 - x2);

    var arctan = Math.atan(slope);

    var set45 = 1.57 / 2;

    if (x1 < x2) {
      set45 = -1.57 * 1.5;
    }


    var arrlen = 15;


    context.moveTo(x2, y2);
    context.lineTo(x2 + Math.cos(arctan + set45) * arrlen,
      y2 + Math.sin(arctan + set45) * arrlen);

    context.moveTo(x2, y2);
    context.lineTo(x2 + Math.cos(arctan - set45) * arrlen,
      y2 + Math.sin(arctan - set45) * arrlen);
  }

  function search() {
    var value = document.getElementById('value').value.trim();
    if (value == "") {
      jAlert("no key entered");
    } else {
      if (tree.search(parseInt(value))) {
        jAlert(value + " is in the tree");
        draw();
      } else {
        jAlert(value + " is not in the tree");
        draw();
      }
    }
  }
</script>


</html>