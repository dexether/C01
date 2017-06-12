var vm = new Vue({
  el: "#app",
  data : {
    nama : "",
    periode : "",
    first_balance : 0,
    last_balance : 0,
    total_credit : 0,
    total_debit : 0,
    mutations : []
  },
  methods: {
    fetchBankStatement : function($event){
      var postData = $($event.target).serializeArray();
      // alert('Hello')
      this.$http.post('ar_wallet_statement_do.php', postData, {
        emulateJSON : true
      }).then(response => {
        this.mutations = response.body.result;
        this.nama = response.body.client_name;
        this.total_credit = response.body.total_credit;
        this.total_debit = response.body.total_debit;
        this.total_credit = response.body.total_credit;
        this.first_balance = response.body.first_balance;
        this.last_balance = response.body.last_balance;
        this.periode = response.body.periode;
      }, response => {
        // error callback
      });
    }
  }
})
