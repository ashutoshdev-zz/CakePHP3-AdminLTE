<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($subscriptionPlan->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriptionPlan->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Type') ?></th>
            <td><?= $subscriptionPlan->has('subscription_type') ? $this->Html->link($subscriptionPlan->subscription_type->name, ['controller' => 'SubscriptionTypes', 'action' => 'view', $subscriptionPlan->subscription_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meals') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->meals) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->status) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscriptionPlan->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subscriptionPlan->modified) ?></td>
        </tr>
 <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= $this->Text->autoParagraph(h($subscriptionPlan->description_short)); ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Long Description') ?></th>
            <td><?= $this->Text->autoParagraph(h($subscriptionPlan->description_long)); ?></td>
        </tr>
    </table>
</div>
 </div>
</div>
</div>
</section>