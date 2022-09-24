new Vue({
    el:"#js",
   
    data:{
        name:"",
        id:"",
        age:"",
        gender:"male",
        msg:"hi iam asaad",
       
        myname:'type here',
        
        perons:[],
       
       
    },
    computed:{
       hii : function (){
            if(this.name == '' || this.id == '' || this.age == ''){
              return true;
            }
            else{
                return false;
            }
        }
    },
    methods:{
        adduser:function(){
           var newpareson={
                name:this.name,
                id:this.id,
                age:this.age,
                gender:this.gender
               
            };
        this.perons.push(newpareson);
              this.name="";
                this.id="";
                this.age="";
               
        },
        deleteuser: function(index){
            this.perons.splice(index,1);
        }
    }
});