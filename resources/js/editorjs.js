import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
// import LinkTool from '@editorjs/link';
import Embed from '@editorjs/embed';
import Quote from '@editorjs/quote';
import ImageTool from '@editorjs/image';
import Iframe from '@hammaadhrasheedh/editorjs-iframe';
import Paragraph from '@editorjs/paragraph';


let saveBtn = document.getElementById('saveBtn');
if (saveBtn) {

    let meta = document.head.querySelector('meta[name="csrf-token"]');

    console.log(meta.content);
    const editor = new EditorJS({
        /**
         * Id of Element that should contain Editor instance
         */
        holder: 'editorjs',

        tools: {
            header: {
                class: Header,
                inlineToolbar: ['link'],
                config: {
                    placeholder: 'Enter a header',
                },
            },
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            // quote: {
            //     class: Quote,
            //     inlineToolbar: true,
            //     shortcut: 'CMD+SHIFT+O',
            //     config: {
            //         quotePlaceholder: 'Enter a quote',
            //         captionPlaceholder: 'Quote\'s author',
            //     },
            // },
            // link: {
            //     class: LinkTool,
            //
            // },
            iframe: Iframe,
            embed: {
                class: Embed,
                config: {
                    services: {
                        youtube: true,
                        html: true
                    }
                }
            },
            // embed: {
            //     class: Embed,
            //     config: {
            //         services: {
            //             youtube: true,
            //             coub: true,
            //             codepen: {
            //                 regex: /https?:\/\/codepen.io\/([^\/\?\&]*)\/pen\/([^\/\?\&]*)/,
            //                 embedUrl: 'https://codepen.io/<%= remote_id %>?height=300&theme-id=0&default-tab=css,result&embed-version=2',
            //                 html: "<iframe height='300' scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'></iframe>",
            //                 height: 300,
            //                 width: 600,
            //                 id: (groups) => groups.join('/embed/')
            //             }
            //         }
            //     }
            // },

            // list: {
            //     class: List,
            //     inlineToolbar: true
            // },
            // image: {
            //     class: ImageTool,
            //     config: {
            //         endpoints: {
            //             byFile: 'https://freudefoto.local/upload', // Your backend file uploader endpoint
            //             byUrl: 'https://freudefoto.local/upload', // Your endpoint that provides uploading by Url
            //         },
            //         additionalRequestHeaders: {
            //             'X-CSRF-TOKEN': meta.content,
            //         }
            //     }
            // }
        },
        // data: {},
        onReady: () => {
            console.log('Editor.js is ready to work!')
        }
    });

    const form = document.getElementById('editor-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission

        // Save Editor.js data
        const editorData = await editor.save();
        console.log(editorData);
        // Create a hidden input to include Editor.js data in the form submission
        const editorInput = document.createElement('input');
        editorInput.type = 'hidden';
        editorInput.name = 'editorContent';
        editorInput.value = JSON.stringify(editorData);

        // Append the hidden input to the form and submit it
        form.appendChild(editorInput);
        form.submit();
    });
    // saveBtn.addEventListener('click', (e) => {
    //     e.preventDefault();
    //     editor.save().then((outputData) => {
    //         axios({
    //             method: 'post',
    //             url: url,
    //             data: {
    //                 content_data: outputData
    //             }
    //         });
    //     }).catch((error) => {
    //         console.log('Saving failed: ', error)
    //     });
    // }, false)
}

