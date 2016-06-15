package cn.edu.hrbeu.util;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Iterator;
import java.util.List;

import org.apache.poi.hssf.usermodel.HSSFCell;
import org.apache.poi.hssf.usermodel.HSSFRow;
import org.apache.poi.hssf.usermodel.HSSFSheet;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.poifs.filesystem.POIFSFileSystem;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFCell;
import org.apache.poi.xssf.usermodel.XSSFRow;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.apache.xmlbeans.*;

public class ReadExcelData {
	
	
	
	public static String[][] getData(String filename)
			throws FileNotFoundException, IOException {
		// List<String[]> result = new ArrayList<String[]>();
		List<String[]> result = new ArrayList<String[]>();
		POIFSFileSystem fs = null;
		Workbook wb = null;
		int type = 0;
		try {
			if(!new File(filename).exists())
			{
				filename+="x";
			}
			
			try{
				fs = new POIFSFileSystem(new FileInputStream(filename));
				wb = new HSSFWorkbook(fs);
				type = 0;
			}catch(Exception e){
					wb = new XSSFWorkbook(new FileInputStream(filename));
				type = 1;
			}
			if(type==0)
			{
				try{
					
					HSSFCell cell = null;
					HSSFSheet st = null;
					int rowSize = 0;
				
						 st = (HSSFSheet) wb.getSheetAt(0);
						int maxRowNum = st.getLastRowNum();
						// 第一行为标题，不取
						for (int rowIndex = 1; rowIndex <= maxRowNum; rowIndex++) {
							HSSFRow row = st.getRow(rowIndex);
							if (row == null) {
								continue;
							}
							int tempRowSize = row.getLastCellNum() + 1;
							if (tempRowSize > rowSize) {
								rowSize = tempRowSize;
							}

							String[ ] values = new String[rowSize];
							Arrays.fill(values, "");

							for (short columnIndex = 0; columnIndex <= row.getLastCellNum(); columnIndex++) {

								String value = "";
								cell = row.getCell(columnIndex);
								if (cell != null) {
									// 注意：一定要设成这个，否则可能会出现乱码
									switch (cell.getCellType()) {
									case HSSFCell.CELL_TYPE_STRING:
										value = cell.getStringCellValue();
										break;

									case HSSFCell.CELL_TYPE_NUMERIC:
										cell.setCellType(Cell.CELL_TYPE_STRING);
						                value = cell.getStringCellValue();
										break;

									case HSSFCell.CELL_TYPE_FORMULA:
										// 导入时如果为公式生成的数据则无值
										if (!cell.getStringCellValue().equals("")) {
											value = cell.getStringCellValue();
										} else {
											value = cell.getNumericCellValue() + "";
										}

										break;

									case HSSFCell.CELL_TYPE_BLANK:
										value="";
										break;

									case HSSFCell.CELL_TYPE_ERROR:
										value = "";
										break;

									case HSSFCell.CELL_TYPE_BOOLEAN:
										value = (cell.getBooleanCellValue() == true ? "Y"
												: "N");
										break;

									default:
										value = "";
									}
								}
								values[columnIndex] = value.trim();
							}

							if(isEmpty(values))
								result.add(values);
							
						}

					String[][] returnArray = new String[result.size()][rowSize];//行=记录的行 列等于最大列

					for (int i = 0; i < returnArray.length; i++) {
						returnArray[i] = (String[]) result.get(i);
					}

					return returnArray;
				}catch(Exception e){
					e.printStackTrace();
					return null;
				}
			}else{
				try{
					
					XSSFCell cell = null;
					XSSFSheet st = null;
					int rowSize = 0;
				
						 st = (XSSFSheet) wb.getSheetAt(0);
						int maxRowNum = st.getLastRowNum();
						// 第一行为标题，不取
						for (int rowIndex = 1; rowIndex <= maxRowNum; rowIndex++) {
							XSSFRow row = st.getRow(rowIndex);
							if (row == null) {
								continue;
							}
							int tempRowSize = row.getLastCellNum() + 1;
							if (tempRowSize > rowSize) {
								rowSize = tempRowSize;
							}

							String[ ] values = new String[rowSize];
							Arrays.fill(values, "");

							for (short columnIndex = 0; columnIndex <= row.getLastCellNum(); columnIndex++) {

								String value = "";
								cell = row.getCell(columnIndex);
								if (cell != null) {
									// 注意：一定要设成这个，否则可能会出现乱码
									switch (cell.getCellType()) {
									case XSSFCell.CELL_TYPE_STRING:
										value = cell.getStringCellValue();
										break;

									case XSSFCell.CELL_TYPE_NUMERIC:
										cell.setCellType(Cell.CELL_TYPE_STRING);
						                value = cell.getStringCellValue();
										break;

									case XSSFCell.CELL_TYPE_FORMULA:
										// 导入时如果为公式生成的数据则无值
										if (!cell.getStringCellValue().equals("")) {
											value = cell.getStringCellValue();
										} else {
											value = cell.getNumericCellValue() + "";
										}

										break;

									case XSSFCell.CELL_TYPE_BLANK:
										value="";
										break;

									case XSSFCell.CELL_TYPE_ERROR:
										value = "";
										break;

									case XSSFCell.CELL_TYPE_BOOLEAN:
										value = (cell.getBooleanCellValue() == true ? "Y"
												: "N");
										break;

									default:
										value = "";
									}
								}
								values[columnIndex] = value.trim();
							}

							if(isEmpty(values))
								result.add(values);
							
						}

					String[][] returnArray = new String[result.size()][rowSize];//行=记录的行 列等于最大列

					for (int i = 0; i < returnArray.length; i++) {
						returnArray[i] = (String[]) result.get(i);
					}

					return returnArray;
				}catch(Exception e){
					e.printStackTrace();
					return null;
				}
			}
			
			
		} catch (IOException e) {
			e.printStackTrace();
			return null;
		}
	}
	private static boolean isEmpty(String[] value){
		int len = value.length;
		for(int i=0;i<len;i++){
			if(value[i].trim()!="")
				return true;
		}
		return false;
	}
}
