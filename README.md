# srk-grid-gridview

# sample 



















$province = DB::table('provinces')->paginate(20);



$grid = new GridView($province,[
        
        
            'prv_name'=>'استان',
        ],[
        
            ['class'=>'fa fa-pencil']
            
        ],[
        
            'data-id'=>'prv_id','color'=>'prv_id'
            
        ]
        
        );
