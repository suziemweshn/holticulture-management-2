<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

 <style>
  .input{
    border:none;
    outline:none;
    width:100%;
    border-radius:3px;
    height:30px;
   
  }
  form{
  
   justify-content:center;
   align-items:center;
   width:100%;

  
  }
  form label{
    font-size:20px;
    font-weight:bold
  }
  fieldset{
    width:90%;
    border-radius:5px;
  }
  .container-fluid{
  position:relative;
  left:400px
  }
  form a button{
    border:1px solid black;
    border-radius:5px;
    background-color:black;
    color:white;
    height:25px;
    margin-top:30px;
    width:30%;
    margin-left:40px;
  }
  form a{
    text-decoration:none;
    font-size:20px;
  }
  
  .checkout-form {
    background: linear-gradient(115deg, rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.719)), url('Nanyuki.jpg') no-repeat;
background-size: cover;
width: 40%;
height: 700px;
border-radius: 5px;

    
 
 
 
}

 </style>
</head>
<body>
    <section class="">
        <div class="container-fluid" style="background: url(../img/flamingo.jpeg)">
        <div class="checkout-form">
            <h3>Customer Address</h3>
          <form action="">
            <fieldset>
<legend>
    <label for="">Name</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your name"  class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Phone Number</label>
   
</legend>
<input type="text" name="name "  placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Email</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Address</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your Address" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Country</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Region</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">City</label>
   
</legend>
<input type="text" name="name " placeholder="Enter your name" class="input" required>

            </fieldset>

            
                   
                   
                      
                    
              <div class="buttons">
              <a href="" class="submit-button"><button type="submit">Submit</button></a>    
 <a href="" class="cancel-button"><button type="submit">Cancel</button></a>
              </div>    
           
        
           
          </form>
        </div>
        </div>
      
    </section>
</body>
</html>