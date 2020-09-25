
<table id="scores-table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>序号</th>
            <th>学院</th>
            <th>姓名</th>
            <th>拟申报职称</th>
            <th>学生评价成绩</th>
            <th>教案评价成绩</th>
            <th>同行评价成绩</th>
            <th>专家评价成绩</th>
            <th>总成绩</th>
            <th>等级</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['department'] }}</td>
                <td>
                    <a href="{{ route('scores.show', $item['id']) }}" title="成绩明细">{{ $item['name'] }}</a>
                </td>
                <td>{{ $item['applied_title'] }}</td>
                <td>{{ $item['student'] }}</td>
                <td>{{ $item['plan'] }}</td>
                <td>{{ $item['peer'] }}</td>
                <td>{{ $item['expert'] }}</td>
                <td>{{ $item['total'] }}</td>
                <td>{{ $item['grade'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>名次</th>
            <th>学院</th>
            <th>姓名</th>
            <th>拟申报职称</th>
            <th>学生评价成绩</th>
            <th>教案评价成绩</th>
            <th>同行评价成绩</th>
            <th>专家评价成绩</th>
            <th>总成绩</th>
            <th>等级</th>
        </tr>
    </tfoot>
</table>