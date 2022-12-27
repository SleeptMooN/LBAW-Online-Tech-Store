function addEventListeners() {
  let itemCheckers = document.querySelectorAll('article.card li.item input[type=checkbox]');
  [].forEach.call(itemCheckers, function(checker) {
    checker.addEventListener('change', sendItemUpdateRequest);
  });

  let itemCreators = document.querySelectorAll('article.card form.new_item');
  [].forEach.call(itemCreators, function(creator) {
    creator.addEventListener('submit', sendCreateItemRequest);
  });

  let itemDeleters = document.querySelectorAll('article.card li a.delete');
  [].forEach.call(itemDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteItemRequest);
  });

  let cardDeleters = document.querySelectorAll('article.card header a.delete');
  [].forEach.call(cardDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteCardRequest);
  });

  let cardCreator = document.querySelector('article.card form.new_card');
  if (cardCreator != null)
    cardCreator.addEventListener('submit', sendCreateCardRequest);
}

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

function sendItemUpdateRequest() {
  let item = this.closest('li.item');
  let id = item.getAttribute('data-id');
  let checked = item.querySelector('input[type=checkbox]').checked;

  sendAjaxRequest('post', '/api/item/' + id, {done: checked}, itemUpdatedHandler);
}

function sendDeleteItemRequest() {
  let id = this.closest('li.item').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/item/' + id, null, itemDeletedHandler);
}

function sendCreateItemRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  let description = this.querySelector('input[name=description]').value;

  if (description != '')
    sendAjaxRequest('put', '/api/cards/' + id, {description: description}, itemAddedHandler);

  event.preventDefault();
}

function sendDeleteCardRequest(event) {
  let id = this.closest('article').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/cards/' + id, null, cardDeletedHandler);
}

function sendCreateCardRequest(event) {
  let name = this.querySelector('input[name=name]').value;

  if (name != '')
    sendAjaxRequest('put', '/api/cards/', {name: name}, cardAddedHandler);

  event.preventDefault();
}

function itemUpdatedHandler() {
  let item = JSON.parse(this.responseText);
  let element = document.querySelector('li.item[data-id="' + item.id + '"]');
  let input = element.querySelector('input[type=checkbox]');
  element.checked = item.done == "true";
}

function itemAddedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);

  // Create the new item
  let new_item = createItem(item);

  // Insert the new item
  let card = document.querySelector('article.card[data-id="' + item.card_id + '"]');
  let form = card.querySelector('form.new_item');
  form.previousElementSibling.append(new_item);

  // Reset the new item form
  form.querySelector('[type=text]').value="";
}

function itemDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);
  let element = document.querySelector('li.item[data-id="' + item.id + '"]');
  element.remove();
}

function cardDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);
  let article = document.querySelector('article.card[data-id="'+ card.id + '"]');
  article.remove();
}

function cardAddedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);

  // Create the new card
  let new_card = createCard(card);

  // Reset the new card input
  let form = document.querySelector('article.card form.new_card');
  form.querySelector('[type=text]').value="";

  // Insert the new card
  let article = form.parentElement;
  let section = article.parentElement;
  section.insertBefore(new_card, article);

  // Focus on adding an item to the new card
  new_card.querySelector('[type=text]').focus();
}

function createCard(card) {
  let new_card = document.createElement('article');
  new_card.classList.add('card');
  new_card.setAttribute('data-id', card.id);
  new_card.innerHTML = `

  <header>
    <h2><a href="cards/${card.id}">${card.name}</a></h2>
    <a href="#" class="delete">&#10761;</a>
  </header>
  <ul></ul>
  <form class="new_item">
    <input name="description" type="text">
  </form>`;

  let creator = new_card.querySelector('form.new_item');
  creator.addEventListener('submit', sendCreateItemRequest);

  let deleter = new_card.querySelector('header a.delete');
  deleter.addEventListener('click', sendDeleteCardRequest);

  return new_card;
}

function createItem(item) {
  let new_item = document.createElement('li');
  new_item.classList.add('item');
  new_item.setAttribute('data-id', item.id);
  new_item.innerHTML = `
  <label>
    <input type="checkbox"> <span>${item.description}</span><a href="#" class="delete">&#10761;</a>
  </label>
  `;

  new_item.querySelector('input').addEventListener('change', sendItemUpdateRequest);
  new_item.querySelector('a.delete').addEventListener('click', sendDeleteItemRequest);

  return new_item;
}

addEventListeners();


$(document).ready(function(){ 
    $('.addToCartBtn').click(function (e){
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var quantity = $(this).closest('.product_data').find('.input-qty').val();  

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            method: "POST",
            url: '/add-to-cart',
            data: {
                'product_id': product_id,
                'quantity': quantity,
            },
            success:function(response){
                alert(response.status);
            }
        });          
    });
    $('.delete-cart-item').click(function (e){
      e.preventDefault();

      var product_id = $(this).closest('.product_data').find('.prod_id').val();  

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({
          method: "POST",
          url: '/delete-cart-item',
          data: {
              'product_id': product_id,
          },
          success:function(response){
              window.location.reload();
              alert(response.status);
          }
      });          
  });
    

  $('.add_btn').click(function (e){
    e.preventDefault();

    //var add_value = $('.input-qty').val();
    var add_value = $(this).closest('.product_data').find('.input-qty').val();
    var value = parseInt(add_value,10);
    value = isNaN(value) ? 0 : value;
    if(value < 10)
    {
      value++;
      //$('.input-qty').val(value);
      $(this).closest('.product_data').find('.input-qty').val(value);
    }
  });

  $('.dec_btn').click(function (e){
    e.preventDefault();

    //var dec_value = $('.input-qty').val();
    var dec_value = $(this).closest('.product_data').find('.input-qty').val();
    var value = parseInt(dec_value,10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
      value--;
      //$('.input-qty').val(value);
      $(this).closest('.product_data').find('.input-qty').val(value);
    }
  });


  $('.changeQuantity').click(function (e){
    e.preventDefault();

    var product_id = $(this).closest('.product_data').find('.prod_id').val();
    var qty = $(this).closest('.product_data').find('.input-qty').val();
    data={
      'product_id' : product_id,
      'quantity': qty,
    }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      method: "POST",
      url: '/update-cart',
      data: data,
      success:function(){
          window.location.reload();
      }
  });
});

});
