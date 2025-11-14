// Sistema de visor de imágenes
        function openImageViewer(element) {
            const img = element.querySelector('img');
            if (img) {
                const modal = document.getElementById('image-viewer-modal');
                const viewerImg = document.getElementById('viewer-image');
                viewerImg.src = img.src;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeImageViewer() {
            const modal = document.getElementById('image-viewer-modal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Sistema de modales
        function openProjectModal(projectId) {
            const modal = document.getElementById('modal-' + projectId);
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeProjectModal(projectId) {
            const modal = document.getElementById('modal-' + projectId);
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        // Cerrar modal al hacer clic fuera del contenido
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('project-modal')) {
                e.target.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        // Sistema de navegación entre páginas
        function changePage(pageId) {
            // Ocultar todas las páginas
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Mostrar la página seleccionada
            document.getElementById(pageId).classList.add('active');
            
            // Actualizar nav activo
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Cerrar menú móvil si está abierto
            document.querySelector('.nav-links').classList.remove('active');
            
            // Scroll al top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Toggle menu móvil
        function toggleMenu() {
            document.querySelector('.nav-links').classList.toggle('active');
        }

        // Configuración de Three.js
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('canvas-container').appendChild(renderer.domElement);

        // Crear partículas
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 3000;
        const posArray = new Float32Array(particlesCount * 3);

        for(let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 100;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.05,
            color: '#ffffff',
            transparent: true,
            opacity: 0.8,
            blending: THREE.AdditiveBlending
        });

        const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particlesMesh);

        // Crear objetos tech-themed
        const techObjects = [];

        // Crear un móvil/smartphone
        function createPhone() {
            const group = new THREE.Group();
            
            const bodyGeometry = new THREE.BoxGeometry(1.5, 3, 0.2);
            const bodyMaterial = new THREE.MeshPhongMaterial({
                color: 0x1a1a1a,
                shininess: 100
            });
            const body = new THREE.Mesh(bodyGeometry, bodyMaterial);
            
            const screenGeometry = new THREE.PlaneGeometry(1.3, 2.6);
            const screenMaterial = new THREE.MeshPhongMaterial({
                color: 0x00ff88,
                emissive: 0x00ff88,
                emissiveIntensity: 0.3
            });
            const screen = new THREE.Mesh(screenGeometry, screenMaterial);
            screen.position.z = 0.11;
            
            group.add(body);
            group.add(screen);
            return group;
        }

        // Crear un ordenador/laptop
        function createLaptop() {
            const group = new THREE.Group();
            
            const baseGeometry = new THREE.BoxGeometry(4, 0.2, 3);
            const baseMaterial = new THREE.MeshPhongMaterial({
                color: 0x2a2a2a,
                shininess: 80
            });
            const base = new THREE.Mesh(baseGeometry, baseMaterial);
            
            const screenGeometry = new THREE.BoxGeometry(4, 2.5, 0.1);
            const screenMaterial = new THREE.MeshPhongMaterial({
                color: 0x0066ff,
                emissive: 0x0066ff,
                emissiveIntensity: 0.3
            });
            const screen = new THREE.Mesh(screenGeometry, screenMaterial);
            screen.position.y = 1.5;
            screen.position.z = -1.5;
            screen.rotation.x = -0.3;
            
            group.add(base);
            group.add(screen);
            return group;
        }

        // Crear símbolos de código
        function createCodeSymbol() {
            const group = new THREE.Group();
            
            const bracketGeometry = new THREE.TorusGeometry(0.8, 0.15, 8, 20, Math.PI);
            const bracketMaterial = new THREE.MeshPhongMaterial({
                color: 0xff00ff,
                wireframe: true
            });
            
            const leftBracket = new THREE.Mesh(bracketGeometry, bracketMaterial);
            leftBracket.rotation.z = Math.PI / 2;
            leftBracket.position.x = -0.5;
            
            const rightBracket = new THREE.Mesh(bracketGeometry, bracketMaterial);
            rightBracket.rotation.z = -Math.PI / 2;
            rightBracket.position.x = 0.5;
            
            group.add(leftBracket);
            group.add(rightBracket);
            return group;
        }

        // Crear matriz de texto estilo hacker
        function createHackerText() {
            const group = new THREE.Group();
            
            for(let i = 0; i < 5; i++) {
                const lineGeometry = new THREE.PlaneGeometry(0.1, 1.5);
                const lineMaterial = new THREE.MeshPhongMaterial({
                    color: 0x00ff00,
                    emissive: 0x00ff00,
                    emissiveIntensity: 0.5,
                    transparent: true,
                    opacity: 0.7
                });
                const line = new THREE.Mesh(lineGeometry, lineMaterial);
                line.position.x = (i - 2) * 0.3;
                group.add(line);
            }
            
            return group;
        }

        // Añadir objetos a la escena
        const phone = createPhone();
        phone.position.set(-15, 5, -20);
        techObjects.push(phone);
        scene.add(phone);

        const laptop = createLaptop();
        laptop.position.set(15, -5, -25);
        techObjects.push(laptop);
        scene.add(laptop);

        const codeSymbol1 = createCodeSymbol();
        codeSymbol1.position.set(-10, -8, -15);
        techObjects.push(codeSymbol1);
        scene.add(codeSymbol1);

        const codeSymbol2 = createCodeSymbol();
        codeSymbol2.position.set(12, 8, -18);
        techObjects.push(codeSymbol2);
        scene.add(codeSymbol2);

        const hackerText = createHackerText();
        hackerText.position.set(0, 0, -30);
        techObjects.push(hackerText);
        scene.add(hackerText);

        // Iluminación
        const light = new THREE.PointLight(0xffffff, 1, 100);
        light.position.set(10, 10, 10);
        scene.add(light);

        const light2 = new THREE.PointLight(0x00ff88, 0.5, 50);
        light2.position.set(-10, -10, 10);
        scene.add(light2);

        const ambientLight = new THREE.AmbientLight(0x404040);
        scene.add(ambientLight);

        camera.position.z = 20;

        // Variables para mouse
        let mouseX = 0;
        let mouseY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth) * 2 - 1;
            mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
        });

        // Animación
        let time = 0;
        function animate() {
            requestAnimationFrame(animate);
            time += 0.01;

            particlesMesh.rotation.y += 0.001;
            particlesMesh.rotation.x += 0.0005;

            techObjects.forEach((obj, i) => {
                obj.rotation.x += 0.005;
                obj.rotation.y += 0.008;
                obj.position.y += Math.sin(time + i) * 0.02;
            });

            camera.position.x += (mouseX * 3 - camera.position.x) * 0.05;
            camera.position.y += (mouseY * 3 - camera.position.y) * 0.05;
            camera.lookAt(scene.position);

            renderer.render(scene, camera);
        }

        animate();

        // Responsive
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    