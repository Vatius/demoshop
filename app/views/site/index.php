<h1>Home Page</h1>
<p>Hello from my Store</p>
<h2>New Products</h2>
<div class="row">
    <?php foreach($products as $item) { ?>
    <div class="col-4 product-preview">
        <div class="pic">
            <img src="/uploads/<?= $item['id'] ?>.jpg">
        </div>
        <p><?= $item['name'] ?></p>
        <span><?= $item['price'] ?>$</span>
        <button data-id="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"><i class="fas fa-cart-plus"></i> Add to cart</button>
    </div>
    <?php } ?>
</div>

