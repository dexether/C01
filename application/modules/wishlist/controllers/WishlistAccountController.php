<?php
/**
 *
 */
use Symfony\Component\HttpFoundation\Request;
class WishlistAccountController extends AuthController
{

  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['wishlists'] = $this->getWishlist()->get();
    $data['contentDashboard'] = 'wishlist/WishlistView';
    $data['du_menu'] = 'du_wishlist';
    $this->template->get_user_dashboard($data);
  }
  public function getWishlist()
  {
    return Wishlist::where('aecodeid', $this->session->aecodeid);
  }
}
