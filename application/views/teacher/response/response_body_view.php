<thead>
  <tr>
    <th>Student Name</th>
    <th>Question Title</th>
    <th>Sno</th>
    <th>Options</th>
    <th>Correct</th>
    <th>Chosen</th>
    <th>Attempted</th>
    <th>Right?</th>
  </tr>
</thead>

<tbody>
  <?php if (!empty($responses)) {
    $st = 0;
    foreach ($responses as $student_id => $response) {
      $st++;
      $sl = 0;
      $total_attempted = 0;
      $total_correct = 0;
      foreach ($response as $question_id => $question) {
        if ($question_id == 'options_total_count') continue;
        $sl++;
        $slc = 0;
        if ($question['correct']) {
          $total_correct++;
        }
        if ($question['attempted']) {
          $total_attempted++;
        }
        foreach ($question['options'] as $option) {
          $slc++; ?>
          <tr>
            <!-- Student Name-->
            <td><?php echo $student_list[$student_id] ?></td>
            <!-- Question -->
            <td> <?php echo $question['q_question'] ?></td>
            <!--  -->
            <td><?php echo $slc ?></td>
            <td><?php echo $option['o_value'] ?></td>
            <?php if ($option['o_correct']) { ?>
              <td class="bg-info text-center" width="10px"><i class="fa fa-check"></i></td>
            <?php } else { ?>
              <td class="bg-warning text-center" width="10px"><i class="fa fa-times"></i></td>
            <?php } ?>

            <?php if ($option['o_id'] == $question['chosen'] && $option['o_correct']) { ?>
              <td class="bg-success text-center" width="10px"><i class="fa  fa-check "></i></td>
            <?php } else { ?>
              <td></td>
            <?php } ?>


            <td class="text-center"><?php echo ($question['attempted']) ? '<i class="fa  fa-check"></i>' : '<i class="fa  fa-times"></i> '; ?></td>
            <td class="text-center"><?php echo ($question['correct']) ? '<i class="fa  fa-check"></i>' : '<i class="fa  fa-times"></i> '; ?></td>
          </tr>
        <?php } // End Option Loop 
        ?>

      <?php } // End Question Loop 
      ?>
      <tr>
        <td class="bg-black"> Total Of Student => <strong><?php echo $student_list[$student_id]; ?></strong></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="bg-black text-center"> <?php echo $total_attempted; ?></td>
        <td class="bg-black text-center"> <?php echo $total_correct; ?></td>
      </tr>
    <?php } //  End Student Loop
    ?>
  <?php } ?>
</tbody>