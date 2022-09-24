/*new Vue({
    el:"#app1",
   
    data:{
      disabled:false,
       postid:"",
       showpost:false,
       post:"",
       
    },
    methods:{
    	selectuser:function(){
    		if(this.postid != ""){
    			this.getpost(this.postid);
    			this.showpost=true;
    		}
    		else{
    			this.showpost=false;
    		}
    	},
    	getpost:function(id){
    		this.$http.get('/posts/' + id).then(function (){

    		},
    		function() {

    		});
    	}
    }
 	
   
});*/