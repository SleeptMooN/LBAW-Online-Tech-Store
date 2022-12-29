

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}


document.querySelectorAll('.addToCartBtn').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;
    var quantity = product_data.querySelector('.input-qty').value;

    var data = {
      product_id: product_id,
      quantity: quantity,
    };

    sendAjaxRequest('POST', '/add-to-cart', data, function(response) {
      var response = JSON.parse(response.target.responseText);
      alert(response.status);
    });
  });
});
  
document.querySelectorAll('.delete-cart-item').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;

    var data = {
      product_id: product_id,
    };

    sendAjaxRequest('POST', '/delete-cart-item', data, function(response) {
      var response = JSON.parse(response.target.responseText);
      window.location.reload();
      alert(response.status);
    });
  });
});

    
   
  document.querySelectorAll('.add_btn').forEach(function(element) {
    element.addEventListener('click', function(e) {
      e.preventDefault();
      
      var add_value = this.closest('.product_data').querySelector('.input-qty').value;
      var value = parseInt(add_value, 10);
      value = isNaN(value) ? 0 : value;
      if (value < 10) {
        value++;
        this.closest('.product_data').querySelector('.input-qty').value = value;
      }
    });
  });
      
    

  document.querySelectorAll('.dec_btn').forEach(function(element) {
    element.addEventListener('click', function(e) {
      e.preventDefault();
  
      var dec_value = this.closest('.product_data').querySelector('.input-qty').value;
      var value = parseInt(dec_value, 10);
      value = isNaN(value) ? 0 : value;
      if (value > 1) {
        value--;
        this.closest('.product_data').querySelector('.input-qty').value = value;
      }
    });
  });
  


  document.querySelectorAll('.changeQuantity').forEach(function(element) {
    element.addEventListener('click', function(e) {
      e.preventDefault();
  
      var product_data = this.closest('.product_data');
      var product_id = product_data.querySelector('.prod_id').value;
      var qty = product_data.querySelector('.input-qty').value;
  
      var data = {
        product_id: product_id,
        quantity: qty,
      };
  
      sendAjaxRequest('POST', '/update-cart', data, function() {
        window.location.reload();
      });
    });
  });
  



