<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D Book Animation</title>
  <style>
    body {
      margin: 0;
      overflow: hidden;
    }
    canvas {
      display: block;
    }
  </style>
</head>
<body>
  <div id="container"></div>
  <div id="normal-content" style="display: none;">
    <!-- Your normal content here -->
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script>
    // Create a scene
    var scene = new THREE.Scene();

    // Create a camera
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    // Create a renderer
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById("container").appendChild(renderer.domElement);

    // Array of texture file paths for the book cover
    var textureUrls = [
      '{{url('/cube')}}/one.png'
    ];

    // Load textures
    var textureLoader = new THREE.TextureLoader();
    var coverTexture = textureLoader.load(textureUrls[0]);

    // Create material for the cover
    var coverMaterial = new THREE.MeshBasicMaterial({ map: coverTexture });

    // Create a box geometry for the book cover
    var coverGeometry = new THREE.BoxGeometry(2, 0.1, 3); // Adjust dimensions as needed

    // Create a mesh for the book cover
    var cover = new THREE.Mesh(coverGeometry, coverMaterial);
    scene.add(cover);

    // Function to animate the book
    function animate() {
      requestAnimationFrame(animate);

      // Rotate the book
      cover.rotation.y += 0.02;
      cover.rotation.x += 0.01;

      renderer.render(scene, camera);
    }

    animate();

    // Hide the book after 5 seconds
    setTimeout(function() {
      document.getElementById("container").style.display = "none";
      document.getElementById("normal-content").style.display = "block"; // Show the normal content
    }, 5000);
  </script>
</body>
</html>
