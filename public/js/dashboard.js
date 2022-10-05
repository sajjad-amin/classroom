// $(document).ready(function(){
// });
let sideBarHeight = $(window).height() - $('#navbar').height() - 16;
let sideBarWidth = $(window).width() - $('#sidebar').width();
$('#sidebar').css('height', sideBarHeight);
$('#dashboardContent').css('width', sideBarWidth);
$('#recentSells').css('height', sideBarHeight - 30);
$('#sidebarBtn').click(function(){
    $('.sidebar').toggleClass('fliph');
});
// display image on select
$('#image').on('change', function (e){
    const file = $(this).prop('files')[0];
    const fileReader = new FileReader();
    fileReader.addEventListener('load', function (e){
        $('#image-display').attr('src', e.target.result);
    });
    fileReader.readAsDataURL(file);
});
$('#product-form').submit(function (e){
    e.preventDefault();
    const url = $(e.target.targetUrl).val();
    const event = $(e.target.actionEvent).val();
    createProduct(url, event);
});
function createProduct(url, event){
    const productCode = $('#product-code').val();
    const image = $('#image').prop('files')[0];
    const category = $('#category_id').val();
    const title = $('#title').val();
    const price = $('#price').val();
    const sellPrice = $('#sell-price').val();
    const quantity = $('#quantity').val();
    const discount = $('#discount').val();
    const shortDescription = $('#short-description').val();
    const description = $('#description').val();
    const attrs = $('.attributes');
    const attrObject = {};
    for(let i = 0; i < attrs.length; i++){
        attrObject[attrs[i].name] = attrs[i].value
    }
    const attributes = JSON.stringify(attrObject);
    const formData = new FormData();
    formData.append('product_code', productCode);
    formData.append('image', image);
    formData.append('category_id', category);
    formData.append('title', title);
    formData.append('price', price);
    formData.append('sell_price', sellPrice);
    formData.append('quantity', quantity);
    formData.append('discount', discount);
    formData.append('short_description', shortDescription);
    formData.append('description', description);
    formData.append('metadata', attributes);
    axios.post(url, formData, {headers: {'content-type':'multipart/form-data'}})
        .then(response => {
            console.log(response);
            if(response.data.success){
                window.location.replace(response.data.redirect_url);
            }
        }).catch(error => {
        console.log(error)
    });
}
function deleteProduct(url){
    if(confirm('Do you want to delete this product?')){
        axios.delete(url).then(response => {
                console.log(response);
                if(response.data.success){
                    window.location.replace(response.data.redirect_url);
                }
            }).catch(error => {
            console.log(error.response.status)
        });
    }
}
