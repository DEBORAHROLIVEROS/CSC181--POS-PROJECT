$(document).ready(function() {

    // alertify.set('notifier','position', 'top-right');

    $(document).on('click','.increment', function (){

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue)){
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }
    });

    $(document).on('click','.decrement', function (){

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }
    });

    function quantityIncDec(prodId, qty){

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty
            },
            success: function (response) {
                var res = JSON.parse(response);

                if(res.status == 200){
                    $('#productArea').load(' #productContent')
                    // alertify.success(res.message);
                }else{
                //    alertify.error(res.message);
                }
            }
        })
    }

    // proceed to place order button click
    $(document).on('click','.proceedToPlace', function () {

        //console.log('proceedToPlace');
        
        var cname = $('#cname').val();
        var payment_mode = $('#payment_mode').val();
        
        if(payment_mode == ''){

            swal("Select Payment Mode","Select your payment mode","warning");
            return false;
        }

        if(cname == '' && !$.isNumeric(cname)){

            swal("Enter Cashier Name","Enter Registered Name","warning");
            return false;
        }

        var data = {
            'proceedToPlaceBtn': true,
            'cname': cname,
            'payment_mode': payment_mode,
        };
    
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            success: function (response){
                var res = JSON.parse(response);
                if(res.status == 200){
                    window.location.href = "order-summary.php";
                    
                }else{
                    swal(res.message, res.message, res.status_type);
                }

            }
        })
    });

    $(document).on('click','#saveOrder', function () {

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder': true
            },
            success: function (response) {
                var res = JSON.parse(response);

                if(res.status == 200){
                    swal(res.message, res.message, res.status_type); 
                    $('#orderPlaceSuccessMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');
                }else{
                    swal(res.message, res.message, res.status_type); 
                }
            }
        });

    });


});

function printMyBillingArea() {
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('','');
    a.document.write('<html><title>POS System in PHP</title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}


window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo){

    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html( elementHTML, {
        callback: function() {
            docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });
}