import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * ------------------------------------------------------------------------------------
 * PROJECT SETUP
 * ------------------------------------------------------------------------------------
 */

// imports
import './bootstrap.js';
import $ from 'jquery';
import jQuery from 'jquery';

import Sortable from 'sortablejs';
import dataTable from 'datatables.net';
import Moment from 'moment';
import 'jquery-ui/dist/jquery-ui';
import languageDE from 'datatables.net-plugins/i18n/de-DE.mjs';
import VenoBox from 'venobox';
import Tagify from '@yaireo/tagify'


// import EditorJS from '@editorjs/editorjs';
// import Header from '@editorjs/header';
// import Embed from '@editorjs/embed';

window.$ = $; // this worked for me
window.jQuery = jQuery;
window.Tagify = Tagify;
window.DataTable = dataTable;
window.Moment = Moment;
window.languageDE = languageDE;
window.Sortable = Sortable;
window.VenoBox = VenoBox;
// import '../sass/app.scss';
