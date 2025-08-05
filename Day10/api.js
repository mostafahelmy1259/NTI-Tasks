// fetch("https://jsonplaceholder.typicode.com/users/").then(Response => Response.json()).then(data => {
//                 console.log(data);
//                 data.forEach(element => {
//                     document.getElementById("read-data").innerHTML += "your name is " + element.name + " and your website is " + element.website + "<br>";
//                 });
                
//             })

// fetch("http:/localhost/Day10/api.php").then(Response => Response.json()).then(data => {
//     console.log(data);
// })

fetch("api.php").then(Response =>{ 
        
                return Response.json()
            }).then(data => {
                if(data.connection){
                    data.data.forEach( item =>{
                        console.log(item);
                    })
                } else {
                    alert(data.message);
                }
                
                
            
})