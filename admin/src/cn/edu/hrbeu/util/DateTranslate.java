package cn.edu.hrbeu.util;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 * 
 * @author congyuandong 时间转换相关类
 */
public class DateTranslate {
	public int CDIM(String date, String month)  {
		int count = 0;
		Date d1 = null, d2 = null;
		Calendar cal = Calendar.getInstance();
		DateFormat df = new SimpleDateFormat("yyyy-MM-dd");
		try {
			d1 = df.parse(date);
			d2 = df.parse(month + "-1");
		} catch (ParseException e) {
			e.printStackTrace();
		}
		
		cal.setTime(d1);
		// 求出date的星期
		int day = cal.get(Calendar.DAY_OF_WEEK);
		cal.setTime(d2);
		int daysOfMonth = cal.getActualMaximum(Calendar.DAY_OF_MONTH);// 本月份的天数
		for (int i = 1; i <= daysOfMonth; i++) {
			String today = month + "-" + String.valueOf(i);
			try {
				cal.setTime(df.parse(today));
			} catch (ParseException e) {
				e.printStackTrace();
			}
			if (day == cal.get(Calendar.DAY_OF_WEEK))
				count++;
		}

		System.out.println(month + "有" + count + "个星期" + (day-1));
		return count;
	}

	public static void main(String[] args) {
		DateTranslate dt = new DateTranslate();
		dt.CDIM("2014-02-23", "2014-10");
	}

}
