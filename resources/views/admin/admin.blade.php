<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hatirpal.com | Admin : Online Wholesale Marketplace In Bangladesh</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="{{asset('images/default/icon/icon.png')}}" />
  <link rel="stylesheet" href="{{asset('sagorstyle/plugins/fontawesome-free/css/all.min.css')}}">
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id='app'>
    @include('admin.includes.nav')
    @include('admin.includes.leftside')

    {{-- @yield('content') --}}
    <div class="content-wrapper">
       <admin-master></admin-master>
    </div>

     
    <footer class="main-footer">
      <strong>Hatirpal ©  @php echo date('Y');  @endphp Online Store. All Rights are Reserved by : <a href="http://hatirpal.com/" target="_blank"> <span style="color:orange">Hatirpal.com</span></a>.</strong>
     
      
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="{{ asset('js/app.js') }}" defer></script>

<script>
  var editor_config = {
    path_absolute : "{{URL::to('/')}}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
  tinymce.init(editor_config);
  </script>
</body>
</html>
