$(".select2").select2();

$(".alert-fade").fadeTo(7000, 1000).fadeOut(600, function(){
    $(".alert-fade").alert('close');
});

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue',
  increaseArea: '15%' // optional
});

$('input[type="checkbox"].minimal, input[type="radio"].minimal').css('padding-left', '10px');

$("#alluserstable").DataTable();

$('.icp-auto').iconpicker();

$(".wysitextarea").wysihtml5();

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
});

$('.action-destroy').on('click', function() {
  $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
});

$(".confirm-link").click(function(e) {
    $('#confirmDialog .modal-title').html($(this).data('title'));
    $('#confirmDialog .modal-body').html($(this).data('body'));
    $('#confirmDialog .btn-ok').attr('href', $(this).attr('href'));
    $('#confirmDialog').modal('show');
    e.preventDefault();
});

$('#StatusDialog').on('show.bs.modal', function(e) {
    code = $(e.relatedTarget).data('code');
    orderurl = $(e.relatedTarget).data('orderurl');
    $("#FormStatus").attr('action',orderurl);
});

$('#aUpdateDialog').on('show.bs.modal', function(e) {
    updaterurl = $(e.relatedTarget).data('updaterurl');

    productid = $(e.relatedTarget).data('productid');
    var inpput_price = 'price'+productid;
    var inpput_quantity = 'quantity'+productid;
    var aprice = $('#'+inpput_price).val();
    var aquantity = $('#'+inpput_quantity).val();
    productname = $(e.relatedTarget).data('productname');
    var url = updaterurl+'/'+trimSpace(aprice)+'/'+trimSpace(aquantity);
    $("#aUpdateDialog #productname").html(productname);
    $("#aupdate").attr('action',url);
});

$('#StatusDialog').on('show.bs.modal', function(e) {
    var code = $(e.relatedTarget).data('code');
    var ourl = $(e.relatedTarget).data('orderurl');
    var trangthai = $(e.relatedTarget).data('status');
    $('#FormStatusOrder [name="status"]').val(trangthai).trigger("change");
    $("#FormStatusOrder").attr('action',ourl);
});

$('#LevelUserDialog').on('show.bs.modal', function(e) {
    var levelurl = $(e.relatedTarget).data('orderurl');
    $("#FormLevelUser").attr('action',levelurl);
});

$( "#seach_order" ).click(function(){
    $("#SeachOrderForm" ).submit();
});



// Create a new password
$(".btn-genpasswd").click(function(){
  // var field = $(this).closest('div').find('input[rel="gp"]');
  var field = $('.genpasswd');
  var password = randString(field);
  field.val(password);
  prompt('Make sure you save your generated password somewhere safe before closing this window!', password)
});

// Auto Select Pass On Focus
$('input[rel="gp"]').on("click", function () {
   $(this).select();
});

$('.sidebar-menu li').each(function(){
	if ($(this).hasClass('active')) {
		$(this).parent('ul').parent('li').addClass('active');
	}
});

function trimSpace(str)
{
    return str.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"").replace(/\s+/g," ");
}

function randString(id){
  var dataSet = $(id).attr('data-character-set').split(','); 
  var possible = '';
  if($.inArray('a-z', dataSet) >= 0){
    possible += 'abcdefghijklmnopqrstuvwxyz';
  }
  if($.inArray('A-Z', dataSet) >= 0){
    possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }
  if($.inArray('0-9', dataSet) >= 0){
    possible += '0123456789';
  }
  if($.inArray('#', dataSet) >= 0){
    possible += '![]{}()%&*$#^<>~@|';
  }
  var text = '';
  for(var i=0; i < $(id).attr('data-size'); i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}

///////////////////////////////// MENU
function editMenu(url) {
    $('#editMenuForm')[0].reset();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editMenuForm').attr('action', url);
            $('#editMenuForm .input-group-addon').html('<i class="fa '+ data.icon +'"></i>');
            $('#editMenuForm [name="icon"]').val(data.icon);
            if (data.parent_slug != '') {
            	$('#editMenuForm [name="parent_slug"]').val(data.parent_slug);
            }else{
            	$('#editMenuForm [name="parent_slug"]').val(null);
            }
            $('#editMenuForm [name="menu_order"]').val(data.menu_order);
            $('#editMenuForm [name="title"]').val(data.title);
            $('#editMenuForm [name="url"]').val(data.url);
            $('#editMenuForm [name="description"]').val(data.description);
            $('#editMenuForm [name="permission_id"]').val(data.permission_id);
            $('#editMenuForm [name="menu_group"]').val(data.menu_group);
            $('#editMenuForm option[value="'+data.menu_group+'"] ').attr('selected', true);

            // Open modal for edit:
            $('#editmenu').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data!');
        }
    });
}
$('#confirmMenuDelete').on('show.bs.modal', function(e) {
  deletemenuurl = $(e.relatedTarget).data('deletemenuurl');
  menuname = $(e.relatedTarget).data('menuname');
  $("#confirmMenuDelete #menuname").html( menuname );
  $("#deleteMenuForm").attr('action', deletemenuurl);
});

$('#translatemenu').on('show.bs.modal', function(e) {
    $('#translateMenuForm')[0].reset();
    translateurl = $(e.relatedTarget).data('translatemenuurl');
    $("#translateMenuForm").attr('action', translateurl);
});

///////////////////////////////// USER
function editUser(url) {
    $('#editUserForm')[0].reset();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editUserForm').attr('action', url);
            $('#editUserForm [name="full_name"]').val(data.full_name);
            $('#editUserForm [name="email"]').val(data.email);
            // Open modal for edit:
            $('#editUser').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data!');
        }
    });
}
function editUserRoles(url) {
  
    $("#updateUserRolesForm input").parent('div').attr('aria-checked', 'false').removeClass('checked');
    $("#updateUserRolesForm input").parent('div').removeClass('checked');
    $("#updateUserRolesForm input").attr("checked", false);
    $('#updateUserRolesForm')[0].reset();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#updateUserRolesForm').attr('action', url);
            for (var key in data) {
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').parent('div').attr('aria-checked', 'true').removeClass('checked');
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').parent('div').addClass('checked');
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').attr("checked", true);
            }
            // Open modal for edit:
            $('#editUserRoles').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data!');
        }
    });
}
$('#confirmUserDelete').on('show.bs.modal', function(e) {
    username = $(e.relatedTarget).data('username');
    userdeleteurl = $(e.relatedTarget).data('userdeleteurl');
    $("#confirmUserDelete #username").html( username );
    $("#delForm").attr('action', userdeleteurl);
});

////////////////// Delete Articles

$('#confirmArticlesDelete').on('show.bs.modal', function(e) {
    articleid = $(e.relatedTarget).data('articleid');
    articlename = $(e.relatedTarget).data('articlename');
    articledeleteurl = $(e.relatedTarget).data('articledeleteurl');
    $("#confirmArticlesDelete #articlename").html( articlename );
    $("#delForm").attr('action',articledeleteurl);
});

////////////////// Delete Products
$('#confirmProductsDelete').on('show.bs.modal', function(e) {
    productid = $(e.relatedTarget).data('productid');
    productname = $(e.relatedTarget).data('productname');
    productdeleteurl = $(e.relatedTarget).data('productdeleteurl');
    $("#confirmProductsDelete #productname").html(productname );
    $("#delForm").attr('action',productdeleteurl);
});
////////////////// Delete Cate Articles
$('#confirmCateDelete').on('show.bs.modal', function(e) {
    cateid = $(e.relatedTarget).data('cateid');
    catename = $(e.relatedTarget).data('catename');
    catedeleteurl = $(e.relatedTarget).data('catedeleteurl');
    $("#confirmCateDelete #catename").html( catename );
    $("#delForm").attr('action',catedeleteurl);
});

///////////////////////////////// ROLE
function editRole(url, locale) {
    $('#editRoleForm')[0].reset();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editRoleForm').attr('action', url);
            if( data.label == null || data.label[locale] == null){
                $('#editRoleForm [name="label"]').val(null);
            }else{
                $('#editRoleForm [name="label"]').val(data.label[locale]);
            }
            // Open modal for edit:
            $('#editRole').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data!');
        }
    });
}
$('#confirmRoleDelete').on('show.bs.modal', function(e) {
    roleid = $(e.relatedTarget).data('roleid');
    roleurl = $(e.relatedTarget).data('roleurl');
    rolename = $(e.relatedTarget).data('rolename');
    $("#confirmRoleDelete #rolename").html( rolename );
    $("#delForm").attr('action', roleurl);
});

//////////////////////////////// PERMISSION
function editPermission(url, locale) {
    $('#editPermissionForm')[0].reset();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editPermissionForm').attr('action', url);
            if( data.label == null || data.label[locale] == null){
                $('#editRoleForm [name="label"]').val(null);
            }else{
                $('#editRoleForm [name="label"]').val(data.label[locale]);
            }
            // Open modal for edit:
            $('#editPermission').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data!');
        }
    });
}


/////////////////////////////////// EmailTemplates
$('#translateemailtemplate').on('show.bs.modal', function(e) {
    $('#translateEmailTemplateForm')[0].reset();
    translateemailtemplateurl = $(e.relatedTarget).data('translateemailtemplateurl');
    $("#translateEmailTemplateForm").attr('action', translateemailtemplateurl);
});


function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
                .join('0');
    }
    return s.join(dec);
}