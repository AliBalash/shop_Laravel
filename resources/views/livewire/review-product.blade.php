<div wire:ignore.self class="modal fade" id="reviewModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div  class="tab-content-item " id="review" >

                    <div class="wrap-review-form" >

                        <div id="comments">
                            <h2 class="woocommerce-Reviews-title"> #{{$product->id}} <span>{{$product->name}}</span>
                            </h2>
                            <ol class="commentlist">
                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                    id="li-comment-20">
                                    <div id="comment-20" class="comment_container">
                                        <img alt="" src="{{asset('assets/images/products')}}/{{$product->image}}"
                                             height="80"
                                             width="80">
                                        <div class="comment-form-rating">
                                            <span>Average rating</span>
                                            <p class="stars" >
                                                <label for="rated-11"></label>
                                                <input type="radio"  id="rated-11"  value="1" wire:model="avrage">
                                                <label for="rated-21"></label>
                                                <input type="radio"  id="rated-21"  value="2" wire:model="avrage">
                                                <label for="rated-31"></label>
                                                <input type="radio"  id="rated-31"  value="3" wire:model="avrage">
                                                <label for="rated-41"></label>
                                                <input type="radio"  id="rated-41"  value="4" wire:model="avrage">
                                                <label for="rated-51"></label>
                                                <input type="radio"  id="rated-51"  value="5" wire:model="avrage">
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div><!-- #comments -->

                        <div id="review_form_wrapper" >
                            <div id="review_form">
                                <div id="respond" class="comment-respond">

                                    <form  class="comment-form">

                                        <div class="comment-form-rating">
                                            <span>Your rating</span>
                                            <p class="stars">
                                                <label for="rated-1"></label>
                                                <input type="radio" id="rated-1" name="rating" value="1"  wire:model="rate">
                                                <label for="rated-2"></label>
                                                <input type="radio" id="rated-2" name="rating" value="2" wire:model="rate">
                                                <label for="rated-3"></label>
                                                <input type="radio" id="rated-3" name="rating" value="3" wire:model="rate">
                                                <label for="rated-4"></label>
                                                <input type="radio" id="rated-4" name="rating" value="4" wire:model="rate">
                                                <label for="rated-5"></label>
                                                <input type="radio" id="rated-5" name="rating" value="5" wire:model="rate">

                                            </p>
                                        </div>

                                        <p class="comment-form-comment">
                                            <label for="comment">Your review <span class="required">*</span>
                                            </label>
                                            <span class="error">@error('rate') {{$message}} @enderror</span>
                                            <textarea id="comment" name="comment" cols="45"
                                                      rows="8" wire:model="comment" placeholder="write your comment ..."></textarea>
                                            <span class="error">@error('comment') {{$message}} @enderror</span>

                                        </p>
                                        <p class="form-submit">
                                            <input  type="submit"  class="submit"  wire:click.prevent="review({{$product->id}})">

                                        </p>
                                    </form>

                                </div><!-- .comment-respond-->
                            </div><!-- #review_form -->
                        </div><!-- #review_form_wrapper -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

