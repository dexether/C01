Number.prototype.formatMoney = function(c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};


Vue.component('change-address', {
    template: '<button v-on:click="changeAddress" type="button" class="btn btn-sm btn-warning" name="button"><i class="glyphicon glyphicon-pencil"></i> Ubah</button>',
    methods: {
        changeAddress: function() {
            console.log('View Modal');
            // $('#myModal').modal('show');
        }
    }
});

Vue.component('set-active-address', {
    template: '<button v-on:click.prevent="setActiveMethod" type="button" class="btn btn-sm btn-default" name="button"><i class="glyphicon glyphicon-ok"></i> Jadikan Utama</button>',
    props: ['message', 'source'],
    data: function() {
        return {
            counter: "No counter",
            nama: 0
        }
    },
    methods: {
        setActiveMethod: function() {
            var data = {
                "address_id": this.message,
                "_token": $.cookie('token'),
                "aecodeid": $('#aecodeid').val()
            }
            this.$http.post('/api/address/set_primary/' + this.message, data, {
                emulateJSON: true
            }).then(function(response) {

                this.$emit('setactivemethod')
            });
        }
    }
})


new Vue({
    el: "#app",
    data: {
        items: [],
        shop: [],
        showCart: false,
        verified: false,
        tempListOngkir: [],
        address: [],
        listOngkir: [],
        ongkir: 0,
        displayAddress: ""
    },
    mounted: function() {
        this.getUsers();
        this.fetchAddress();
    },
    ready: function() {
        this.getUsers();
        this.fetchAddress();

    },
    computed: {
        computedAddress() {
            return this.tempListOngkir;
        },
        totalNumber() {
            var total = 0;
            for (var i = 0; i < this.shop.length; i++) {
                total += this.shop[i].subtotal;
            }
            return total;
        },
        total() {
            var total = 0;
            for (var i = 0; i < this.shop.length; i++) {
                total += this.shop[i].subtotal;
            }
            return (total).formatMoney(2, '.', ',');
        },
        subtotalCheckout() {
            var subtotal = 0;

            subtotal = this.totalNumber + this.ongkir;
            return subtotal;
        }
    },
    methods: {
        fetchSelectedOngkir: function(event) {
            this.ongkir = this.listOngkir[event.target.value].harga_akhir;
        },
        fetchSelectedAddress: function(event) {
            this.displayAddress = this.address[event.target.value];
            this.fetchOngkir(this.displayAddress.city_id);
        },
        fetchAddress: function() {
            var aecodeid_id = document.getElementById("aecodeid");
            if (aecodeid_id != null) {
                var aecodeid = document.getElementById("aecodeid").value;
            } else {
                var aecodeid = null;
            }
            if (aecodeid != null) {
                var link = '/address/api/list/' + aecodeid;
                this.$http.get(link).then(function(response) {
                    this.address = response.data;
                    // this.fetchOngkir();
                }, function(error) {});
            }
        },
        getUsers: function() {
            var link = '/cart/set_item';
            this.$http.get(link).then(function(response) {
                this.shop = response.data;
            }, function(error) {});
        },
        addToCart(item, e) {
            var btn_cart = e.target;
            $(btn_cart).html('Sudah ditambah ke Keranjang');
            var link = '/cart/set_items/' + item;
            this.$http.get(link).then(function(response) {
                // this.shop.push(response.data);
                this.getUsers();
            }, function(error) {});
        },
        fetchOngkir: function(city_id) {
            // POST /someUrl
            var data = this.shop;

            this.$http.post('/ongkir/post/api/' + city_id, data, {
                emulateJSON: false
            }).then(function(response) {
                this.listOngkir = response.data;
            });
        },
        getBuyerDefaultAddress: function() {
            // /address/addresscontroller/getUserDefaultAddress/1066
        },
        removeFromCart(item) {
            var link = '/cart/remove_item/' + item;
            this.$http.get(link).then(function(response) {
                // this.shop.push(response.data);
                this.getUsers();
            }, function(error) {

            });
        },
        fetchTips: function() {
            this.$http.get('/api/tips', function(tips) {
                this.$set('tips', tips)
            });
        },
        setWishList(id){
          let data = {
              "_token": $.cookie('token'),
              "id" : id
          };
          this.$http.post('/api/wishlist/set_wishlist', data, {
              emulateJSON: true
          }).then(response => {
            toastr.info('Berhasil menambahkan ke Wishlist')
          }).catch(error => {
              toastr.error(error.body.message);
              if(error.status == 401){
                window.location = "/auth";
              }

          });
        }
    }
});
