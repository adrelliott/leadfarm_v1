Leadfarm_v1
===========

Version 1 of the Leadfarm app (This is where the 5 elements are separated)

This app is developed using 5 distinct stages to render a page (and an array for each)

1. $this->data['Config']. This array is copied from config/bespoke_configs/XXXXX_config.php (where XXXXX is the Dataowner_Id), and holds all the info required for to render each page. This array is  unset as we move to next stage.
2. $this->data['model_setup'] copies relevant data from the config fiel and methods from MY_Controller cycle through this and do the relevant queries. All results from the queries are copied to the controller_setup (below) for post-CRUD processing. This array is  unset as we move to next stage.
3. $this->data['controller_setup'] intially holds all the raw data for the page from model_setup, but this part of the contrller then processes these (things like dates/timestamps, and genrating dropdowns based on queries) to turn them into HTML. This HTML is stored in the 'view_setup' array ready to be echod to the page. This array is  unset as we move to next stage.
4. $this->data['view_setup'. As well as strogin all the dynamic HTML required for the page, earlier processes also write variables such as record Id ($rID) and contact id's ($ContactId) to this array which acts as a central sotrage for references required in the model setup. There shoudl be no coding required in the actual view fiels as the HTML shoudl already have been generated. (**Is size of array an issue here??? Might we end up with an array of HTMl that's too big? Its not soteed in the $_SESSION)
5. Fonally, once the HTMl is outputed to the page, there is some Javascript and JQUERY that make things beautoful. this si the final piec eof the puzzle.

I'd lie to keep this code as bug free as poss so we try to use branches where we can, with ref numbers (#32) that refer tot he card number in Trello.

Final Notes:
- I prefer tabs not spaces when writign code
- - I define functions liek this : 
  function name (para) {
      //Your code
  }
- I define arrays like this:
  $var = array
  (
      key => val,
  );


