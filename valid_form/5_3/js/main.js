var chlidNum = [];
var lastChild = 0;

$(function () {

    $('#add_btn').click(function () {
        lastChild = parseInt(chlidNum[chlidNum.length - 1]) + 1;
        newChild = parseInt(chlidNum[chlidNum.length - 1]) + 1;
        chlidNum.push(""+newChild);
        $('tbody').append("<tr id='c"+lastChild+"'>"+
            "<td>"+
                "<select class='cg-select' id='cg"+lastChild+"' name=''>"+
                    "<option value='0' selected='selected'> NOT LOGGED IN </option>"+
                    "<option value='1'> General </option>"+
                    "<option value='2'> Wholesale </option>"+
                    "<option value='3'> Retailer </option>"+
                "</select>"+
            "</td>"+
            "<td>"+
                "<input type='text' class='required-num'  name='' id='am"+lastChild+"' >"+
            "</td>"+
            "<td>"+
                "<button  type='button' class='del-btn' onclick='delMe("+lastChild+");' style='border:0;' > "+
                        '<svg style="color: #514943; width: 17px;" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg>'+
                "</button>"+
            "</td>"+
        "</tr>");
    });

    populateAll();

    $('.sv-btn').click(function() {
        testFlag = true;
        var state = $('#sel_state').val();
        var tmsg = $('#txtmsg').val();
        $('.tempmsg').remove();
        // $('input.tempmsg').css('border-color', '#adadad');
        $('input#txtmsg').css('border-color', '#adadad');
        $('#tempbmsg').remove();

        $('input[name]').each(function( index ) {
            var regex = /^[0-9]+$/;
            $(this).after(''); 
            if($(this).val().trim() == "") {
                testFlag = false;
                $(this).css('border-color', '#e22626');
                $(this).after('<p class="tempmsg" style="max-width: 100px;box-sizing: border-box; border:1px solid #e22626;margin: 2px 0 0;padding: 6px 10px 10px;background: #fff8d6;color: #555;font-size: 12px;font-weight: 500;" >This is a required field.</p>');
                
            }else if(!regex.test($(this).val())) {   
                testFlag = false;
                $(this).css('border-color', '#e22626');
                $(this).after('<p class="tempmsg" style="max-width: 100px;box-sizing: border-box; border:1px solid #e22626;margin: 2px 0 0;padding: 6px 10px 10px;background: #fff8d6;color: #555;font-size: 12px;font-weight: 500;" >Please enter a valid number in this field.</p>');
        
            }
        }); 
        $('input#txtmsg').each(function( index ) {
            var regex = /^[0-9]+$/;
            $(this).after(''); 
            console.log("blank checking...|"+$('input#txtmsg').val()+"|");
            if($('input#txtmsg').val().trim() == "") {
                console.log("blank found");
                testFlag = false;
                $(this).css('border-color', '#e22626');
                $(this).after('<p id="tempbmsg" style="max-width: 100%;box-sizing: border-box; border:1px solid #e22626;margin: 2px 0 0;padding: 6px 10px;background: #fff8d6;color: #555;font-size: 12px;font-weight: 500;" >This is a required field.</p>');   
            }
        }); 
        ar1 = [];
        ar2 = [];
        $('.cg-select').each(function() {
            ar1.push($(this).val());
        });
        $('.required-num').each(function() {
            ar2.push($(this).val());
        });
        if(testFlag == true){
            data = {
                st: state,
                cg: ar1,
                ma: ar2,
                msg: tmsg
            };
            // console.log(JSON.stringify(data));
            $.post('main.php', JSON.stringify(data), function(response) {
                if(response != 2) {
                    $('tbody').html('');
                    populateAll();
                    console.log("1");
                    $('.pmsg-div').css("display", "flex")
                }else {
                    console.log("0");
                    $('.pmsg-div').css("display", "none")
                }
            });
        } 
    });
    

    $('#sel_state').on('change', function() {
        // console.log($(this).val());
        if($(this).val() == 1) {
            $('.ff2').show();
            $('.ff3').show();
        }else {
            $('.ff2').hide();
            $('.ff3').hide();
        }
    });
    
});

function populateAll() {
    chlidNum = [];
    $.post("con.inc.php", function (data) {
        adata = JSON.parse(data);
        $('#sel_state').val(adata[0][0]);
        $('#txtmsg').val(adata[0][3]);
        for(var i = 0; i < adata[0][1].length; i++) {
            addRow(adata[0][1][i], adata[0][2][i]);
            chlidNum.push(adata[0][1][i]);
        }
    });
}

function addRow(val, val2) {
    var ar_opt = ['NOT LOGGED IN', 'General', 'Wholesale', 'Retailer'];
    var opt = '';
    for(var i = 0; i <= 3; i++) {
        if(val == i) {
            opt += "<option value='"+i+"' selected='selected' > "+ar_opt[i]+" </option>";
        }else {
            opt += "<option value='"+i+"'> "+ar_opt[i]+" </option>";
        }
    }
    $('tbody').append("<tr id='c"+val+"'>"+
        "<td>"+
            "<select class='cg-select' id='cg"+val+"' name=''>"+opt+
            "</select>"+
        "</td>"+
        "<td>"+
            "<input type='text' class='required-num' value='"+val2+"' name='' id='am"+val+"' >"+
        "</td>"+
        "<td>"+
            "<button  type='button' class='del-btn' onclick='delMe("+val+");' style='border:0;' > "+
                '<svg style="color: #514943; width: 17px;" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg>'+
            "</button>"+
        "</td>"+
    "</tr>");
    
}


function delMe(e) {
    $("#c"+e).remove();
    chlidNum.splice(chlidNum.indexOf(""+e), 1);
    console.log(chlidNum);
}