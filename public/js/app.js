
function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  fetch(url, {
    method: method,
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    body: encodeForAjax(data),
  })
  .then(function(response) {
    return response.json();
  })
  .then(handler);
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

    fetch('/add-to-cart', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      document.getElementById('message').innerHTML = response.status;
    });
  });
});



document.querySelectorAll('.addToCart').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;
    var quantity = 1;

    var data = {
      product_id: product_id,
      quantity: quantity,
    };

    fetch('/add-to-cart', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      document.getElementById('message').innerHTML = response.status;
    });
  });
});


document.querySelectorAll('.addToCart_WL').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;
    var quantity = 1;

    var data = {
      product_id: product_id,
      quantity: quantity,
    };

    fetch('/add-to-cart', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      product_data.remove();
      document.getElementById('message').innerHTML = response.status;
    });
  });
});


document.querySelectorAll('.addToWishBtn').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;

    var data = {
      product_id: product_id,
    };

    fetch('/update_wishlist', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      document.getElementById('message').innerHTML = response.status;
    });
  });
});



  
document.querySelectorAll('.wishlist-remove-btn').forEach(function(element) {
  element.addEventListener('click', function(e) {
    e.preventDefault();

    var product_data = this.closest('.product_data');
    var product_id = product_data.querySelector('.prod_id').value;

    var data = {
      product_id: product_id,
    };

    fetch('/remove_wishlist', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      product_data.remove();
      document.getElementById('message').innerHTML = response.status;
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

    fetch('/delete-cart-item', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: encodeForAjax(data),
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      window.location.reload();
      document.getElementById('message').innerHTML = response.status;
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

      var product_data = this.closest('.product_data');
      var product_id = product_data.querySelector('.prod_id').value;
      var quantity = product_data.querySelector('.input-qty').value;

      var data = {
        product_id: product_id,
        quantity: quantity,
      };

      fetch('/add-to-cart', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: encodeForAjax(data),
      })
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

      var product_data = this.closest('.product_data');
      var product_id = product_data.querySelector('.prod_id').value;
      var quantity = product_data.querySelector('.input-qty').value;

      var data = {
        product_id: product_id,
        quantity: quantity,
      };

      fetch('/add-to-cart', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: encodeForAjax(data),
      })
      
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

  
  



  document.addEventListener('DOMContentLoaded', function() {
    loadCart();
  
    function loadCart() {
      var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      var headers = { 'X-CSRF-TOKEN': csrfToken };
  
      fetch('/load-cart-data', {
        method: 'GET',
        headers: headers
      })
        .then(function(response) {
          return response.json();
        })
        .then(function(response) {
          document.querySelector('.cart-count').innerHTML = response.count;
        })
        .catch(function(error) {
          console.error(error);
        });
    }
  });
  