<div class="col-xs-6 col-sm-3 ms2_product col-mobail">
[[-<tablet><div class="col-xs-6 col-sm-4 ms2_product"></tablet>
<mobile><div class="col-xs-6 col-sm-6 ms2_product col-mobail"></mobile>]]
    <div class="product-block clearfix">
	<div class="span2 col-md-4"><img src="{$thumb ?: '/assets/components/ruwines/img/no-img/no-images-60x210.png'}" class="img-product img-responsive" alt="" /></div>
	<div class="row span10 col-md-8">
		<form method="post" id="dynamic-[[+id]]" class="ms2_form">
                    <h4 class="title-product"><a href="{$_modx->makeUrl($id)}"><strong>{$pagetitle}</strong></a></h4>
                    <p class="font-alt parametr-product">{$color} {$size}</p>
			<span class="">{$weight == 0 ? '' : $weight}</span><br />
                        <div class="price"><span class="price-int"><strong>{$price}</strong></span> <strong>{$_modx->lexicon('ms2_frontend_currency')}</strong></div>
                        
                        {if $balances == 0}
                            <button data-title="{$pagetitle}" data-toggle="modal" data-target="#supply-modal" data-url="{$_modx->makeUrl($id)}" type="submit" class="btn btn-default add-btn supply-add">Сообщить о поступлении</button>
                        {else}
                            
                            <button class="btn btn-default add-btn" type="submit" name="ms2_action" value="cart/add">
                                <img class="add-car" src="/assets/components/ruwines/img/add-car.png" width="23" height="13"/> Добавить
                            </button>
                            
                        {/if}
                        
                        [[-!informMe? &id=`[[+id]]` &class=`msProductData` &select=`balances`]]
                        
			<input type="hidden" name="id" value="{$id}">
			<input type="hidden" name="count" value="1">
			<input type="hidden" name="options" value="[]">
		</form>
	</div>
        
        [[!msOptions?
            &product = `[[+id]]`
        ]]
        
    </div>
    
    {include 'offerStickerR'}
</div>

<!--minishop2_old_price <span class="old_price">[[+old_price]] [[%ms2_frontend_currency]]</span>-->
