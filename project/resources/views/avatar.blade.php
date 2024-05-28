<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>3d content</title>
		<style>
			body,
html {
    margin: 0;
    padding: 0;
}

* {
    touch-action: manipulation;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

body {
    position: relative;
    font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    width: 100%;
    height: 100vh;
    background: #f1f1f1;
}

.frame {
    top: 0;
    position: absolute;
    left: 0;
    padding: 2rem;
    z-index: 10;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.frame__title {
    font-size: 1rem;
    margin: 0 1.5rem 0.5rem 0;
    display: inline-block;
    font-weight: 500;
}

.frame__links {
    display: inline-block;
}

.frame__links a {
    display: inline-block;
    text-decoration: none;
    color: #78ab82;
}

.frame__links a:not(:last-child) {
    margin: 0 1.5rem 0.5rem 0;
}

.frame__links a:focus,
.frame__links a:hover {
    text-decoration: underline;
}

.action {
    position: absolute;
    bottom: 2rem;
    width: 100%;
    text-align: center;
    color: #d97043;
    font-style: italic;
    z-index: 10;
    pointer-events: none;
}

.wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#c {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    display: block;
}

.loading {
    position: fixed;
    z-index: 50;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #f1f1f1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader {
    -webkit-perspective: 120px;
    -moz-perspective: 120px;
    -ms-perspective: 120px;
    perspective: 120px;
    width: 100px;
    height: 100px;
}

.loader::before {
    content: "";
    position: absolute;
    left: 25px;
    top: 25px;
    width: 50px;
    height: 50px;
    background-color: #9bffaf;
    animation: flip 1s infinite;
}

@keyframes flip {
    0% {
        transform: rotate(0);
    }

    50% {
        transform: rotateY(180deg);
    }

    100% {
        transform: rotateY(180deg) rotateX(180deg);
    }
}
		</style>
		
	
  </head>
	<body>
		<div class="loading" id="js-loader">
			<div class="loader"></div>
		</div>
		<div class="wrapper">
		   
			<canvas id="c"></canvas>
		</div>
		<div class="frame">
			
		</div>
		
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/108/three.min.js'></script>
	
		<script src='https://cdn.jsdelivr.net/gh/mrdoob/Three.js@r92/examples/js/loaders/GLTFLoader.js'></script>
		
		<script>
     
    </script>
    <script>
		document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("HEllo world");
	</script>
    <script>
		(function () {

let scene,
renderer,
camera,
model, 
neck, 
waist, 
possibleAnims, 
mixer, 
idle, 
clock = new THREE.Clock(), 
currentlyAnimating = false, 
raycaster = new THREE.Raycaster(),
loaderAnim = document.getElementById('js-loader');

init();

function init() {

  const MODEL_PATH = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/1376484/stacy_lightweight.glb';
  const canvas = document.querySelector('#c');
  const backgroundColor = 0xf1f1f1;

  
  scene = new THREE.Scene();
  scene.background = new THREE.Color(backgroundColor);
  scene.fog = new THREE.Fog(backgroundColor, 60, 100);

  
  renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
  renderer.shadowMap.enabled = true;
  renderer.setPixelRatio(window.devicePixelRatio);
  document.body.appendChild(renderer.domElement);

 
  camera = new THREE.PerspectiveCamera(
  50,
  window.innerWidth / window.innerHeight,
  0.1,
  1000);

  camera.position.z = 30;
  camera.position.x = 0;
  camera.position.y = -3;

  let stacy_txt = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1376484/stacy.jpg');
  stacy_txt.flipY = false;

  const stacy_mtl = new THREE.MeshPhongMaterial({
	map: stacy_txt,
	color: 0xffffff,
	skinning: true });



  var loader = new THREE.GLTFLoader();

  loader.load(
  MODEL_PATH,
  function (gltf) {
	model = gltf.scene;
	let fileAnimations = gltf.animations;

	model.traverse(o => {

	  if (o.isMesh) {
		o.castShadow = true;
		o.receiveShadow = true;
		o.material = stacy_mtl;
	  }
	  
	  if (o.isBone && o.name === 'mixamorigNeck') {
		neck = o;
	  }
	  if (o.isBone && o.name === 'mixamorigSpine') {
		waist = o;
	  }
	});

	model.scale.set(7, 7, 7);
	model.position.y = -11;

	scene.add(model);

	loaderAnim.remove();

	mixer = new THREE.AnimationMixer(model);

	let clips = fileAnimations.filter(val => val.name !== 'idle');
	possibleAnims = clips.map(val => {
	  let clip = THREE.AnimationClip.findByName(clips, val.name);

	  clip.tracks.splice(3, 3);
	  clip.tracks.splice(9, 3);

	  clip = mixer.clipAction(clip);
	  return clip;
	});


	let idleAnim = THREE.AnimationClip.findByName(fileAnimations, 'idle');

	idleAnim.tracks.splice(3, 3);
	idleAnim.tracks.splice(9, 3);

	idle = mixer.clipAction(idleAnim);
	idle.play();

  },
  undefined, 
  function (error) {
	console.error(error);
  });


  
  let hemiLight = new THREE.HemisphereLight(0xffffff, 0xffffff, 0.61);
  hemiLight.position.set(0, 50, 0);
  
  scene.add(hemiLight);

  let d = 8.25;
  let dirLight = new THREE.DirectionalLight(0xffffff, 0.54);
  dirLight.position.set(-8, 12, 8);
  dirLight.castShadow = true;
  dirLight.shadow.mapSize = new THREE.Vector2(1024, 1024);
  dirLight.shadow.camera.near = 0.1;
  dirLight.shadow.camera.far = 1500;
  dirLight.shadow.camera.left = d * -1;
  dirLight.shadow.camera.right = d;
  dirLight.shadow.camera.top = d;
  dirLight.shadow.camera.bottom = d * -1;
 
  scene.add(dirLight);


 
  let floorGeometry = new THREE.PlaneGeometry(5000, 5000, 1, 1);
  let floorMaterial = new THREE.MeshPhongMaterial({
	color: 0xeeeeee,
	shininess: 0 });


  let floor = new THREE.Mesh(floorGeometry, floorMaterial);
  floor.rotation.x = -0.5 * Math.PI;
  floor.receiveShadow = true;
  floor.position.y = -11;
  scene.add(floor);

  let geometry = new THREE.SphereGeometry(8, 32, 32);
  let material = new THREE.MeshBasicMaterial({ color: 0x9bffaf }); // 0xf2ce2e 
  let sphere = new THREE.Mesh(geometry, material);

  sphere.position.z = -15;
  sphere.position.y = -2.5;
  sphere.position.x = -0.25;
  scene.add(sphere);
}


function update() {
  if (mixer) {
	mixer.update(clock.getDelta());
  }

  if (resizeRendererToDisplaySize(renderer)) {
	const canvas = renderer.domElement;
	camera.aspect = canvas.clientWidth / canvas.clientHeight;
	camera.updateProjectionMatrix();
  }

  renderer.render(scene, camera);
  requestAnimationFrame(update);
}

update();

function resizeRendererToDisplaySize(renderer) {
  const canvas = renderer.domElement;
  let width = window.innerWidth;
  let height = window.innerHeight;
  let canvasPixelWidth = canvas.width / window.devicePixelRatio;
  let canvasPixelHeight = canvas.height / window.devicePixelRatio;

  const needResize =
  canvasPixelWidth !== width || canvasPixelHeight !== height;
  if (needResize) {
	renderer.setSize(width, height, false);
  }
  return needResize;
}

window.addEventListener('click', e => raycast(e));
window.addEventListener('touchend', e => raycast(e, true));

function raycast(e, touch = false) {
  var mouse = {};
  if (touch) {
	mouse.x = 2 * (e.changedTouches[0].clientX / window.innerWidth) - 1;
	mouse.y = 1 - 2 * (e.changedTouches[0].clientY / window.innerHeight);
  } else {
	mouse.x = 2 * (e.clientX / window.innerWidth) - 1;
	mouse.y = 1 - 2 * (e.clientY / window.innerHeight);
  }
  
  raycaster.setFromCamera(mouse, camera);

  
  var intersects = raycaster.intersectObjects(scene.children, true);

  if (intersects[0]) {
	var object = intersects[0].object;

	if (object.name === 'stacy') {

	  if (!currentlyAnimating) {
		currentlyAnimating = true;
		playOnClick();
	  }
	}
  }
}


function playOnClick() {
  let anim = Math.floor(Math.random() * possibleAnims.length) + 0;
  playModifierAnimation(idle, 0.25, possibleAnims[anim], 0.25);
}


function playModifierAnimation(from, fSpeed, to, tSpeed) {
  to.setLoop(THREE.LoopOnce);
  to.reset();
  to.play();
  from.crossFadeTo(to, fSpeed, true);
  setTimeout(function () {
	from.enabled = true;
	to.crossFadeTo(from, tSpeed, true);
	currentlyAnimating = false;
  }, to._clip.duration * 1000 - (tSpeed + fSpeed) * 1000);
}

document.addEventListener('mousemove', function (e) {
  var mousecoords = getMousePos(e);
  if (neck && waist) {

	moveJoint(mousecoords, neck, 50);
	moveJoint(mousecoords, waist, 30);
  }
});

function getMousePos(e) {
  return { x: e.clientX, y: e.clientY };
}

function moveJoint(mouse, joint, degreeLimit) {
  let degrees = getMouseDegrees(mouse.x, mouse.y, degreeLimit);
  joint.rotation.y = THREE.Math.degToRad(degrees.x);
  joint.rotation.x = THREE.Math.degToRad(degrees.y);
  console.log(joint.rotation.x);
}

function getMouseDegrees(x, y, degreeLimit) {
  let dx = 0,
  dy = 0,
  xdiff,
  xPercentage,
  ydiff,
  yPercentage;

  let w = { x: window.innerWidth, y: window.innerHeight };

 
  if (x <= w.x / 2) {
   
	xdiff = w.x / 2 - x;
	
	xPercentage = xdiff / (w.x / 2) * 100;
	
	dx = degreeLimit * xPercentage / 100 * -1;
  }

 
  if (x >= w.x / 2) {
	xdiff = x - w.x / 2;
	xPercentage = xdiff / (w.x / 2) * 100;
	dx = degreeLimit * xPercentage / 100;
  }
  
  if (y <= w.y / 2) {
	ydiff = w.y / 2 - y;
	yPercentage = ydiff / (w.y / 2) * 100;
	
	dy = degreeLimit * 0.5 * yPercentage / 100 * -1;
  }
  
  if (y >= w.y / 2) {
	ydiff = y - w.y / 2;
	yPercentage = ydiff / (w.y / 2) * 100;
	dy = degreeLimit * yPercentage / 100;
  }
  return { x: dx, y: dy };
}

})();
	</script>
	</body>
</html>