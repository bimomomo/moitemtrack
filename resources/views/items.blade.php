<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- STYLE/SCRIPT SRC START --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    {{-- STYLE/SCRIPT SRC END --}}
    <style>
        .modal {
            padding: 0;
            background: #0000;
            max-width: 90%;
        }
        .jquery-modal {
            z-index: 9999;
        }
        th {
            vertical-align: top;
        }
    </style>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-right" style="z-index: 7777;">
                    <span onclick="toggleDisplayForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>
                    </span>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800" style="z-index: 7777;" id="itemInputContainer">
                    <form action="#" onsubmit="saveitemdata(event)" id="formInputItem" id="formItemInput">
                        <div class="dateditwarn text-yellow-300 mb-6" style="display: none;"><b>EDITING DATA</b></div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="item_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="item_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                <input type="hidden" id="item_id"/>
                                @csrf
                            </div>
                            <div>
                                <label for="item_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="item_category" class="slc2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="width: 100%" required>
                                    
                                </select>
                            </div>
                            <div>
                                <label for="item_tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                                <select id="item_tags" multiple class="slc2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="width: 100%">
                                    
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="item_images">Images</label>
                                <input type="file" multiple="multiple" id="item_images" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="item_description">Description</label>
                                <textarea id="item_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Properties</label>
                                
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="ctrInpPrprt">
                                    <td>
                                        <input type="text" id="item_property_key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    </td>
                                    <td class="text-center">:</td>
                                    <td>
                                        <input type="text" id="item_property_val" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    </td>
                                    <td>
                                        <button onclick="addproperties()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                                            <span class="sr-only">Add</span>
                                        </button>
                                    </td>
                                </table>
                                <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="ctrItmPrprt"></table>
                            </div>
                        </div>
                        <div class="mb-6">
                        </div>
                        <div class="mb-6 text-right">
                            <button onclick="resetval()" type="button" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"></path><path d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z"></path></svg>
                                Reset
                            </button>
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path></svg>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="p-6 sticky top-0 text-center bg-white dark:bg-gray-800" style="z-index: 7777;">
                    <div class="relative">
                        <input type="text" name="q" id="searchitemtextinput" class="w-full border h-12 shadow p-4 rounded-full dark:text-gray-800 dark:border-gray-700 dark:bg-gray-200" placeholder="search" oninput="drawitemlistcard()">
                        <svg class="text-gray-400 h-5 w-5 absolute top-3.5 right-3 fill-current dark:text-gray-300"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 56.966 56.966"
                            style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="itemCardContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-7 gap-5 place-content-center">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed right-9 bottom-9">
            <button onclick="getitem()" type="button" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"></path><path d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z"></path></svg>
                <span class="sr-only">REFRESH</span>
            </button>
            <button onclick="$(window).scrollTop(0);" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="m6.293 13.293 1.414 1.414L12 10.414l4.293 4.293 1.414-1.414L12 7.586z"></path></svg>
                <span class="sr-only">UP</span>
            </button>
        </div>
        <div id="modalshowDetailItem" class="modal" style="z-index: 9999;">
            <div class="w-full h-full bg-white dark:bg-gray-800" style="border-radius: 8px;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table style="w-full">
                        <tr>
                            <th>Name</th><th><span class="pl-3 pr-2"> : </span></th>
                            <td id="tdItem-name"></td>
                        </tr>
                        <tr>
                            <th>Category</th><th><span class="pl-3 pr-2"> : </span></th>
                            <td id="tdItem-category"></td>
                        </tr>
                        <tr>
                            <th>Tag</th><th><span class="pl-3 pr-2"> : </span></th>
                            <td id="tdItem-tag"></td>
                        </tr>
                        <tr>
                            <th>Description</th><th><span class="pl-3 pr-2"> : </span></th>
                            <td id="tdItem-description"></td>
                        </tr>
                        <tr>
                            <th>Properties</th><th><span class="pl-3 pr-2"> : </span></th>
                            <td id="tdItem-properties"></td>
                        </tr>
                    </table>
                    <hr class="pt-3">
                    <hr>
                    <hr class="pb-3">
                    <div id="imageCardContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-7 gap-5 place-content-center"></div>
                </div>
            </div>
        </div>
        <div id="divcolgenerator" hidden>
            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">cg</span>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">cg</span>
            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">cg</span>
            <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">cg</span>
            <span class="bg-amber-100 text-amber-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-amber-900 dark:text-amber-300">cg</span>
            <span class="bg-slate-100 text-slate-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-slate-900 dark:text-slate-300">cg</span>
            <span class="bg-zinc-100 text-zinc-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-zinc-900 dark:text-zinc-300">cg</span>
            <span class="bg-stone-100 text-stone-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-stone-900 dark:text-stone-300">cg</span>
            <span class="bg-teal-100 text-teal-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-teal-900 dark:text-teal-300">cg</span>
        </div>
        {{-- IMG COMPRESSOR START --}}
        <script src="https://cdn.jsdelivr.net/npm/@sitelintcode/optimize-image-on-the-client-side@0.0.44/dist/optimize-image-on-the-client-side.js"></script>
        <script>
            (function() {
                const optimizeImage = new window.sitelint.OptimizeImage();
                optimizeImage.install();
            }())
        </script>
        {{-- IMG COMPRESSOR END --}}
        <script>
            var item_properties = {};
            var item_data = [];
            var form_display = false;
            var ajaxrunnning = 0;
            $(document).ready(function () {
                $(".slc2").select2({
                    tags: true,
                    theme: 'tailwindcss-3',
                });
                getitem();
                $('#itemInputContainer').hide();
            });

            function toggleDisplayForm() {
                if (form_display) {
                    $('#itemInputContainer').hide();
                    form_display = false;
                } else {
                    $('#itemInputContainer').show();
                    form_display = true;
                }
            }

            function getitem() {
                $.modal.close();
                if (ajaxrunnning==1) {
                    alert('Ajax is running. Try again later.....')
                    return;
                }
                ajaxrunnning = 1;
                $.ajax({
                    type: "GET",
                    url: "/item-data",
                    success: function (response) {
                        ajaxrunnning = 0;
                        item_data = response.item;
                        var c = '<option></option>';
                        response.category.forEach(e => {
                            c+='<option>'+e+'</option>';
                        });
                        $('#item_category').html(c);
                        var t = '';
                        response.tag.forEach(e => {
                            t+='<option>'+e+'</option>';
                        });
                        $('#item_tags').html(t);
                        $(".slc2").select2({
                            tags: true,
                            theme: 'tailwindcss-3',
                        });
                        drawitemlistcard();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown, ) {
                        ajaxrunnning = 0;
                        alert(XMLHttpRequest.status + ': ' + (XMLHttpRequest.responseText).replace(/\\/g,''));
                    }
                });
            }

            function drawitemlistcard() {
                var h = '';
                var s = ($('#searchitemtextinput').val()).trim().toUpperCase();
                item_data.forEach((e, i) => {
                    if(!s || s == '' || e.category.toUpperCase().includes(s) || e.name.toUpperCase().includes(s) || e.description.toUpperCase().includes(s)){
                        h+='<div class="rounded overflow-hidden shadow-lg flex flex-col">';
                        h+='    <div class="relative text-center" style="background-image:url(\'/recfil?rf='+e.image_main+'\');background-size:cover;background-position:center;">';
                        h+='        <a onclick="showDetailItem('+i+')">';
                        h+='            <img class=""';
                        h+='                src="/recfil?rf='+e.image_main+'"';
                        h+='                alt="MainImg" style="height:190px;opacity:0;">';
                        h+='            <div';
                        h+='                class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">';
                        h+='            </div>';
                        h+='        </a>';
                        h+='        <a href="#!">';
                        h+='            <div';
                        h+='                class="text-xs absolute top-0 right-0 bg-indigo-600 px-4 py-2 text-white mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">';
                        h+='                '+e.category;
                        h+='            </div>';
                        h+='        </a>';
                        h+='    </div>';
                        h+='    <div class="px-6 py-4 mb-auto">';
                        h+='        <a href="#"';
                        h+='            class="font-medium text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">'+e.name+'</a>';
                        h+='        <p class="text-gray-500 text-sm">';
                        h+='            '+e.description;
                        h+='        </p>';
                        h+='    </div>';
                        h+='    <div class="grid grid-cols-3">';
                        h+='        <div class="text-center bg-yellow-500" style="cursor:pointer;" onclick="edtitemdata('+i+')">';
                        h+='            EDT';
                        h+='        </div>';
                        h+='        <div class="text-center" style="cursor:pointer;">';
                        h+='            ';
                        h+='        </div>';
                        h+='        <div class="text-center bg-red-500" style="cursor:pointer;" onclick="delitemdata('+e.id+')">';
                        h+='            DEL';
                        h+='        </div>';
                        h+='    </div>';
                        h+='</div>';
                    }
                });
                $('#itemCardContainer').html(h);
            }

            function showDetailItem(i) {
                var itm = item_data[i];
                var imglst = itm.image_list;

                var tag = '';
                if (itm.tag) {
                    var tjsn = JSON.parse(itm.tag);
                    if (Array.isArray(tjsn)){
                        tjsn.forEach(t => {
                            var c = 'stone';
                            if (t.toUpperCase() == 'MAINLINE') {c = 'blue';}
                            if (t.toUpperCase() == 'TH') {c = 'green';}
                            if (t.toUpperCase() == 'STH') {c = 'purple';}
                            if (t.toUpperCase() == 'PREMIUM') {c = 'amber';}
                            if (t.toUpperCase() == 'SILVER') {c = 'slate';}
                            if (t.toUpperCase() == 'CARDED') {c = 'teal';}
                            tag += '<span class="bg-'+c+'-100 text-'+c+'-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-'+c+'-900 dark:text-'+c+'-300">'+t.toUpperCase()+'</span>';
                        });
                    }
                }
                var prop = '<table>';
                if (itm.properties) {
                    prp = JSON.parse(itm.properties);
                    for (const k in prp) {
                        if (Object.prototype.hasOwnProperty.call(prp, k)) {
                            const e = prp[k];
                            prop += '<tr><th>'+k+' </th><th><span class="pl-3 pr-2"> : </span></th><td>'+e+'</td></tr>';
                        }
                    }
                }
                prop += '</table>';

                var img = '';
                if (imglst) {
                    for (let i = 0; i < imglst.length; i++) {
                        const e = imglst[i];
                        img+='<div class="rounded overflow-hidden shadow-lg flex flex-col">';
                        img+='    <div class="relative text-center" style="background-image:url(\'/recfil?rf='+e+'\');background-size:cover;background-position:center;">';
                        img+='        <a href="/recfil?rf='+e+'" target="_blank">';
                        img+='            <img class=""';
                        img+='                src="/recfil?rf='+e+'"';
                        img+='                alt="MainImg" style="height:190px;opacity:0;">';
                        img+='            <div';
                        img+='                class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">';
                        img+='            </div>';
                        img+='        </a>';
                        img+='    </div>';
                        img+='    <div class="grid grid-cols-1">';
                        img+='        <div class="text-center bg-red-500" style="cursor:pointer;" onclick="delimgdata(\''+e+'\', '+itm.id+')">';
                        img+='            DEL';
                        img+='        </div>';
                        img+='    </div>';
                        img+='</div>';
                    }
                }

                $('#tdItem-name').html(itm.name);
                $('#tdItem-category').html(itm.category);
                $('#tdItem-tag').html(tag);
                $('#tdItem-description').html(itm.description);
                $('#tdItem-properties').html(prop);
                $('#imageCardContainer').html(img);

                console.log(itm);
                $('#modalshowDetailItem').modal();
            }

            function resetval() {
                $('#item_name').val('').trigger('change');
                $('#item_id').val('').trigger('change');
                $('#item_category').val('').trigger('change');
                $('#item_tags').val('').trigger('change');
                $('#item_images').val('').trigger('change');
                $('#item_description').val('').trigger('change');
                $('#item_property_key').val('').trigger('change');
                $('#item_property_val').val('').trigger('change');
                $('.dateditwarn').hide();
                item_properties = {};
                drawproperties();
            }

            function drawproperties() {
                var h = '';
                var i = 0;
                for (const k in item_properties) {
                    i++;
                    if (Object.prototype.hasOwnProperty.call(item_properties, k)) {
                        const e = item_properties[k];
                        h += '<tr class="tritmprprt" ordnum="'+i+'">';
                        h += '    <td class="text-center pl-3">';
                        h += '        <span style="cursor: pointer;" onclick="delprop(\''+k+'\')">';
                        h += '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(248, 11, 11);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>';
                        h += '        </span>';
                        h += '    </td>';
                        h += '    <th class="text-left">'+k+'</th>';
                        h += '    <td class="text-center"><span class="pl-3 pr-2"> : </span></td>';
                        h += '    <td class="text-left">'+e+'</td>';
                        h += '</tr>';
                    }
                }
                $('#ctrItmPrprt').html(h);
            }

            function addproperties() {
                var k = $('#item_property_key').val();
                var v = $('#item_property_val').val();
                if (k && v) {
                    item_properties[k] = v;
                    $('#item_property_key').val('');
                    $('#item_property_val').val('');
                    drawproperties();
                }
            }

            function delprop(k) {
                delete item_properties[k];
                drawproperties();
            }

            function saveitemdata(event) {
                event.preventDefault();
                var files = $("#item_images").get(0).files;
                var frmdat = new FormData();

                frmdat.append("_token", $('input[name="_token"]').val());
                frmdat.append("name", $('#item_name').val());
                frmdat.append("id", $('#item_id').val());
                frmdat.append("category", $('#item_category').val());
                frmdat.append("tags", $('#item_tags').val());
                frmdat.append("description", $('#item_description').val());
                frmdat.append("properties", JSON.stringify(item_properties));
                // frmdat.append("images", files);
                for (var i = 0; i < files.length; i++) {
                    frmdat.append("images" + i, files[i]);
                }
                if (ajaxrunnning==1) {
                    alert('Ajax is running. Try again later.....')
                    return;
                }
                ajaxrunnning = 1;
                $.ajax({
                    type: "POST",
                    url: "/item-data",
                    data: frmdat,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        ajaxrunnning = 0;
                        resetval();
                        getitem();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown, ) {
                        ajaxrunnning = 0;
                        alert(XMLHttpRequest.status + ': ' + (XMLHttpRequest.responseText).replace(/\\/g,''));
                    }
                });
            }

            function delitemdata(id) {
                if (confirm('DELETE ITEM?')==true) {
                    if (ajaxrunnning==1) {
                        alert('Ajax is running. Try again later.....')
                        return;
                    }
                    ajaxrunnning = 1;
                    $.ajax({
                        type: "DELETE",
                        url: "/item-data/"+id,
                        data: {
                            _token: $('input[name="_token"]').val(),
                        },
                        success: function (response) {
                            ajaxrunnning = 0;
                            resetval();
                            getitem();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown, ) {
                            ajaxrunnning = 0;
                            alert(XMLHttpRequest.status + ': ' + (XMLHttpRequest.responseText).replace(/\\/g,''));
                        }
                    });
                }
            }

            function delimgdata(img,id) {
                if (confirm('DELETE IMAGE?')==true) {
                    if (ajaxrunnning==1) {
                        alert('Ajax is running. Try again later.....')
                        return;
                    }
                    ajaxrunnning = 1;
                    $.ajax({
                        type: "DELETE",
                        url: "/item-data/"+id,
                        data: {
                            _token: $('input[name="_token"]').val(),
                            delimg: 1,
                            imgurl: img,
                        },
                        success: function (response) {
                            ajaxrunnning = 0;
                            resetval();
                            getitem();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown, ) {
                            ajaxrunnning = 0;
                            alert(XMLHttpRequest.status + ': ' + (XMLHttpRequest.responseText).replace(/\\/g,''));
                        }
                    });
                }
            }

            function compressimage(img) {
                
            }

            function edtitemdata(i) {
                var itm = item_data[i];
                $('#item_name').val(itm.name).trigger('change');
                $('#item_id').val(itm.id).trigger('change');
                $('#item_category').val(itm.category).trigger('change');
                $('#item_tags').val((itm.tag)?JSON.parse(itm.tag):'').trigger('change');
                $('#item_images').val('').trigger('change');
                $('#item_description').val(itm.description).trigger('change');
                $('#item_property_key').val('').trigger('change');
                $('#item_property_val').val('').trigger('change');
                $('.dateditwarn').show();
                item_properties = (itm.properties)?JSON.parse(itm.properties):{};
                drawproperties();
                form_display = false;
                toggleDisplayForm();
            }
        </script>
    </div>
</x-app-layout>