
jQuery(document).ready(function($) {
  var slider = $('#lightSlider').lightSlider({
  	
  	item:1,
  	gallery:true,
  	loop:false,
  	thumbItem:5,
  	vertical:false,
  	
  	onSliderLoad: function (el) {
  		
  		el.lightGallery({
  			
  			selector: '#lightSlider .lslide'
  			
  		})
  		
  	},
  	//vThumbWidth:50,
  	//verticalHeight:250,
  	//thumbMargin:10
  	
  	//slideMove:1,
  	//speed:100,
  	//slideMargin:30,
  	
  	/*responsive: [
  		
  		{
			breakpoint:800,
			settings: {
				item:3,
				slideMove:2,
				slideMargin:10
			}
		},
		
		{
			breakpoint:400,
			settings: {
				item:2,
				slideMove:1,
				slideMargin:1
			}
		}
  	
  	],*/
  	
  	//autoWidth:true,
  	//adaptiveHeight:true,
  	//rtl:true,
  	
  }); 
  
  $('#button').click(function () {
  	
  	slider.goToPrevSlide();
  	
  	
  });
  
   
});

jQuery(document).ready(function($) {
  var slider = $('#lightSlider_fate').lightSlider({
    
    item:1,
    gallery:true,
    loop:false,
    thumbItem:5,
    vertical:false,
    
    onSliderLoad: function (el) {
      
      el.lightGallery({
        
        selector: '#lightSlider_fate .lslide'
        
      })
      
    },
    //vThumbWidth:50,
    //verticalHeight:250,
    //thumbMargin:10
    
    //slideMove:1,
    //speed:100,
    //slideMargin:30,
    
    /*responsive: [
      
      {
      breakpoint:800,
      settings: {
        item:3,
        slideMove:2,
        slideMargin:10
      }
    },
    
    {
      breakpoint:400,
      settings: {
        item:2,
        slideMove:1,
        slideMargin:1
      }
    }
    
    ],*/
    
    //autoWidth:true,
    //adaptiveHeight:true,
    //rtl:true,
    
  }); 
  
  $('#button').click(function () {
    
    slider.goToPrevSlide();
    
    
  });
  
   
});

jQuery(document).ready(function($) {
  var slider = $('#lightSlider_user').lightSlider({
    
    item:1,
    gallery:false,
    loop:false,
    thumbItem:5,
    vertical:false,
    
    onSliderLoad: function (el) {
      
      el.lightGallery({
        
        selector: '#lightSlider_user .lslide'
        
      })
      
    },
    //vThumbWidth:50,
    //verticalHeight:250,
    //thumbMargin:10
    
    //slideMove:1,
    //speed:100,
    //slideMargin:30,
    
    /*responsive: [
      
      {
      breakpoint:800,
      settings: {
        item:3,
        slideMove:2,
        slideMargin:10
      }
    },
    
    {
      breakpoint:400,
      settings: {
        item:2,
        slideMove:1,
        slideMargin:1
      }
    }
    
    ],*/
    
    //autoWidth:true,
    //adaptiveHeight:true,
    //rtl:true,
    
  }); 
  
  $('#button').click(function () {
    
    slider.goToPrevSlide();
    
    
  });
  
   
});
