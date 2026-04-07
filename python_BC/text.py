import time, datetime
import pymysql

#   脚本主要作用是创建“九江海寿岛项目”最早和最晚的班次
#

# server = 'localhost'
# user = 'lundu'
# password = 'wyGezDh2SbdNw7JN'
server = '172.16.16.11'
user = 'root'
password = 'Ecloudm.com+-,&=!@#0065$%^*().|'
database = 'lundu'


# 写日志
def use_log(result_txt):
    now_time_html = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S") + ' : ' + str(result_txt) + '\r\n'
    with open('text_log.txt', 'a') as f:
        f.write(now_time_html)
        f.close()


# 把时间字符串转化为时间戳
def time_str_stamp(time_str):
    # 输入的时间字符串
    # time_str = "2026-01-02 12:12:30"
    tz = datetime.timezone(datetime.timedelta(hours=8))
    dt = datetime.datetime.strptime(time_str, "%Y-%m-%d %H:%M:%S").replace(tzinfo=tz)
    timestamp = int(dt.timestamp())
    return timestamp


# 把时间戳转化为时间字符串
def time_stamp_str(timestamp):
    # timestamp = 1767327150
    tz = datetime.timezone(datetime.timedelta(hours=8))
    dt = datetime.datetime.fromtimestamp(timestamp, tz=tz)
    time_str = dt.strftime("%Y-%m-%d %H:%M:%S")
    return time_str


# update更新数据库
def con_update(updatesql):
    connection = pymysql.connect(host=server, user=user, password=password, database=database, port=3306,
                                 charset='utf8', cursorclass=pymysql.cursors.DictCursor, connect_timeout=20)
    cursor = connection.cursor()
    cursor.execute(updatesql)
    connection.commit()
    cursor.close()
    connection.close()
    return True


# 查询数据
def con_select(select_sql):
    connection = pymysql.connect(host=server, user=user, password=password, database=database, port=3306,
                                 charset='utf8', cursorclass=pymysql.cursors.DictCursor, connect_timeout=20)
    cursor = connection.cursor()
    cursor.execute(select_sql)
    select_date = cursor.fetchall()
    return_date = select_date
    cursor.close()
    connection.close()
    return return_date


# 查询进出岛的最后一个班次
def select_sailing(lltype):
    selectsql = "SELECT * FROM ld_sailing WHERE type=" + str(lltype) + " ORDER BY id DESC LIMIT 1;"
    ldsailinglist = con_select(selectsql)
    use_log("查询进出岛的最后一个班次：： " + str(selectsql))
    return ldsailinglist[0].get("name"), ldsailinglist[0].get("create_time"), ldsailinglist[0].get("weather")


# 查人流
def human_sum(lltype, createtimes, nowstampl):
    ldsailinghumansql = ("SELECT * FROM ld_sailing_human WHERE type= " + str(lltype) +
                         " and create_time>=" + str(createtimes) +
                         " and create_time<=" + str(nowstampl))
    ldsailinghumanlist = con_select(ldsailinghumansql)
    use_log("查人流：： " + str(ldsailinghumansql))

    enterss = ldsailinghumanlist[0].get("current_enters")
    entersl = ldsailinghumanlist[len(ldsailinghumanlist) - 1].get("current_enters")

    return str(int(entersl) - int(enterss))


# 查车流
def car_sum(lltype, createtimes, nowstampl):
    # 查车流
    ldsailingcarsql = ("SELECT COUNT(id) FROM ld_sailing_car WHERE type= " + str(lltype) +
                       " and create_time>=" + str(createtimes) +
                       " and create_time<=" + str(nowstampl))
    ldsailingcarlist = con_select(ldsailingcarsql)
    use_log("查车流：： " + str(ldsailingcarsql))
    return str(ldsailingcarlist[0].get("COUNT(id)"))


# 创建班次
def add_sailing(lltype, lselectdatename, lnowstamp, lcurrenttime, lcurrentdate, lhumansum, lcarsum, lselectdateweather):
    print("lcurrenttime::: ", lcurrenttime)
    lcurrenttime = "6028"
    insertsql = ("INSERT INTO `lundu`.`ld_sailing` (`type`, `name`, `status`, `create_time`, `update_time`, `delete_time`, `remark`, "
                 "`shipping_line_id`, `sailing_date`, `user_id`, `human_num`, `car_num`, `weather`, `create_by`,"
                 "`push_time`, `push_by`, `car_human_num`) VALUES ")
    insertsql += ("(" + str(lltype) + ", '" + str(lselectdatename) + "', 1, " + str(lnowstamp) + ", " + str(lnowstamp) +
                  ", 0, '" + str(lcurrenttime) + "', " + str(int(lltype)+1) + ", '" + str(lcurrentdate) + "', 1, " + str(lhumansum) + ", " + str(lcarsum) +
                  ", '" + str(lselectdateweather) + "', '管理员', " + str(lnowstamp) + ", '管理员', " + str(lcarsum) + ");")
    print(insertsql)
    use_log("创建班次：： " + str(insertsql))
    con_update(insertsql)
    return True

# 判断执行逻辑,传入进离类型和开始时间，如果没有传入开始时间就用最后一个班次查到的创建时间来查询人流和车流总数
def execute_sailing(lltype, stime="False"):
    selectdatename, selectdatecreatetime, selectdateweather = select_sailing(lltype)  # 查最后一班船，传入类型（进：0；离：1）
    if stime != "False":
        selectdatecreatetime = stime
    humansum = human_sum(lltype, selectdatecreatetime, nowstamp)  # 人流（传入：类型，开始时间，结束时间）
    carsum = car_sum(lltype, selectdatecreatetime, nowstamp)  # 车流（传入：类型，开始时间，结束时间）
    re_sailing = add_sailing(lltype, selectdatename, nowstamp, currenttime, currentdate, humansum, carsum, selectdateweather)  # 插入班次
    return re_sailing


use_log("开始运行..... ")
while True:
    now = datetime.datetime.now()
    currenttime = now.strftime("%H:%M:%S")  # 格式：11:13:45
    currentdate = now.date()    # 格式：2026-01-10
    nowstr = now.strftime("%Y-%m-%d %H:%M:%S")  # 格式：格式：2026-01-10 11:13:45
    nowstamp = str(time_str_stamp(nowstr))  # 格式（时间戳）：1768031750

    # 零晨时获取日期，确定每天更新一个航班一次
    # 海寿岛 → 九江 离岛(type=1,shipping_line_id=2)  05:00:00； 06:30:00； 21:45:00
    # 九江 → 海寿岛 进岛(type=0,shipping_line_id=1)  05:20:00； 22:00:00
    if str(currenttime) == "00:00:00":
        use_log("零点更新last_reminded_date的日期" + str(currentdate))
    elif str(currenttime) == "05:00:00":
        ltype = 1  # 离岛
        lstime = str(time_str_stamp(str(currentdate) + " 00:00:00"))
        execute_sailing(ltype, lstime)
        use_log("海寿岛 → 九江 05:00:00 记录成功 " + str(currentdate))
    elif str(currenttime) == "06:30:00":
        ltype = 1  # 离岛
        execute_sailing(ltype)
        use_log("海寿岛 → 九江 06:30:00 记录成功 " + str(currentdate))
    elif str(currenttime) == "21:45:00":
        ltype = 1  # 离岛
        execute_sailing(ltype)
        use_log("海寿岛 → 九江 21:45:00 记录成功 " + str(currentdate))
    elif str(currenttime) == "05:20:00":
        ltype = 0  # 离岛
        lstime = str(time_str_stamp(str(currentdate) + " 00:00:00"))
        execute_sailing(ltype, lstime)
        use_log("九江 → 海寿岛 05:20:00 记录成功 " + str(currentdate))
    elif str(currenttime) == "22:00:00":
        ltype = 0  # 离岛
        execute_sailing(ltype)
        use_log("九江 → 海寿岛 22:00:00 记录成功 " + str(currentdate))
    # else:
    #     print("进入来了~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
    #     ltype = 1  # 离岛
    #     lstime = str(time_str_stamp(str(currentdate) + " 00:00:00"))
    #     execute_sailing(ltype)
    #     exit()

    time.sleep(1)
