// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import * as bootstrap from 'bootstrap'; // import dan assign ke variable
import 'bootstrap-icons/font/bootstrap-icons.css';
window.bootstrap = bootstrap;           // expose ke global window

// Import custom script (di bawah setelah Bootstrap siap)
import './custom/admin.js';
