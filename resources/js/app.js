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
import 'jquery-ui/dist/jquery-ui';
import Sortable from 'sortablejs';
import dataTable from 'datatables.net';
import Moment from 'moment';
import languageDE from 'datatables.net-plugins/i18n/de-DE.mjs';
import VenoBox from 'VenoBox';
import Tagify from '@yaireo/tagify'
import hljs from 'highlight.js';
// import EditorJS from '@editorjs/editorjs';
// import Header from '@editorjs/header';
// import Embed from '@editorjs/embed';

window.VenoBox = VenoBox;
window.Tagify = Tagify;
window.hljs = hljs;
window.DataTable = dataTable;
window.Moment = Moment;
window.languageDE = languageDE;
window.Sortable = Sortable;
// window.EditorJS = EditorJS;
// window.Header = Header;
// window.Embed = Embed;


