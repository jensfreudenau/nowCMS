import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery';
import jQuery from 'jquery';
import VenoBox from 'venobox';
window.jQuery = jQuery;
window.$ = $;
window.VenoBox = VenoBox;

