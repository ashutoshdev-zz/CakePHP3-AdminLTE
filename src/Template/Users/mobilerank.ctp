<div id="cnfrmation_sec">
  <div class="container">
    <div class="weekly_compaign">
      <div class="col-sm-8 col-sm-offset-2">
        <h1 style="color:#5a5b5b;">The Ultimate Plaiter campaign</h1>
        <p>This is a weekly competition</p>
        <div class="week_Sadul">
        <div class="">
          <table class="table-bordered rank_table">
            <thead>
                
              <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Points</th>
                <th>prizes offered</th>
              </tr>
               
            </thead>
            <tbody>
                <?php $i=1; foreach($data as $d) {  ?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $d->user->fname.$d->user->lname; ?></td>
                <td><?php echo $d->points; ?></td>
                <td>Not Decleared</td>
              </tr>
           <?php } ?>
    
            </tbody>
          </table>
        </div>
        
        
        <div class="table-inside">
          <table class="table-bordered rank_table">
       
            <tbody>
              <tr>
                <th scope="row">Top 5 :</th>
                <td>Receive 1 year free subscription + 1 year internships at Plait Food (Green Highlight for top 5 )</td>
              </tr>
              
              <tr>
                <th scope="row">Position 6 - 15 :</th>
                <td>6 months free subscription ( Blue Highlight from position )</td>
              </tr>
              
              <tr>
                <th scope="row">Position 16 - 25 :</th>
                <td>3 months free subscription ( Orange Highlight from position)</td>
              </tr>
              
              <tr>
                <th scope="row">Position 25 - 30 :</th>
                <td>1 month free subscription ( Yellow Highlight from position)</td>
              </tr>
              
              <tr>
                <th scope="row">Position 30 -50 :</th>
                <td>One single free meal ( Red Highlight from position)</td>
              </tr>
              
            </tbody>
          </table>
        </div>
        
        
        </div>
      </div>
      
      
    </div>
  </div>
</div>