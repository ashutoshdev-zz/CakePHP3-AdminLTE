<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($subscriptionType->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriptionType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subscriptionType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subscriptionType->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscriptionType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subscriptionType->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= $this->Text->autoParagraph(h($subscriptionType->description)); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Subscription Plans') ?></h4>
        <?php if (!empty($subscriptionType->subscription_plans)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Day') ?></th>
                <th scope="col"><?= __('Subscription Type Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subscriptionType->subscription_plans as $subscriptionPlans): ?>
            <tr>
                <td><?= h($subscriptionPlans->id) ?></td>
                <td><?= h($subscriptionPlans->name) ?></td>
                <td><?= h($subscriptionPlans->description) ?></td>
                <td><?= h($subscriptionPlans->price) ?></td>
                <td><?= h($subscriptionPlans->day) ?></td>
                <td><?= h($subscriptionPlans->subscription_type_id) ?></td>
                <td><?= h($subscriptionPlans->status) ?></td>
                <td><?= h($subscriptionPlans->created) ?></td>
                <td><?= h($subscriptionPlans->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SubscriptionPlans', 'action' => 'view', $subscriptionPlans->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SubscriptionPlans', 'action' => 'edit', $subscriptionPlans->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SubscriptionPlans', 'action' => 'delete', $subscriptionPlans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionPlans->id),'class'=>'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
 </div>
</div>
</div>
</section>