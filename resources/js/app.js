// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import $ from 'jquery';
import * as bootstrap from 'bootstrap'; // import dan assign ke variable
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

window.bootstrap = bootstrap;
window.$ = $;
window.jQuery = $;

// Import custom script (di bawah setelah Bootstrap siap)
import './custom/admin.js';
